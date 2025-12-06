<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CustomersModel;
use App\Models\NinepayTransactionsModel;

use App\Services\Payment\NinePayService;
use App\Services\QRCodeService;

class Topup9PayController extends Controller
{
    protected $qrcodes;
    protected $ninepays;

    public function __construct(NinePayService $ninepay, QRCodeService $qrcode)
    {
        $this->ninepays = $ninepay;
        $this->qrcodes = $qrcode;
    }

    public function showForm()
    {
        return view('customer.topup.form');
    }

    public function topup(Request $request)
    {
        $customer = Auth::guard('customer')->user();      

        if (!$customer) {
            abort(403, 'Customer not authenticated.');
        }

        $validated = $request->validate([
            'amount'            => 'required|numeric|min:5|max:50',
            // 'fees_amount'       => 'required|numeric',
            // 'received_amount'   => 'required|numeric',
            // 'chain'             => 'required|string',
            // 'currency'          => 'required|string'
        ]);    

        // --- ETH Wallet Logic ---
        if (empty($customer->eth_9pay_json)) 
        {
            $ninepay_eth = $this->ninepays->getEthWallet($customer);
            $customer->eth_9pay_json = $ninepay_eth;
            $customer->save();
        }

        // --- TRON Wallet Logic ---
        if (empty($customer->tron_9pay_json)) 
        {
            $ninepay_tron = $this->ninepays->getTronWallet($customer);
            $customer->tron_9pay_json = $ninepay_tron;
            $customer->save();
        }

        // --- Process Wallets & Generate QR Codes ---
        // Decode the JSON strings into PHP arrays
        $eth_array = json_decode($customer->eth_9pay_json, true);
        $tron_array = json_decode($customer->tron_9pay_json, true);

        // Basic check to ensure decoding worked and 'address' key exists
        if (!isset($eth_array['address']) || !isset($tron_array['address'])) {
            return response()->json(['error' => 'Could not retrieve valid wallet addresses.'], 500);
        }

        // Generate QR codes using your service (make sure generate returns the Base64 URI if used in a view)
        $ethQrCode = $this->qrcodes->generate($eth_array['address']);
        $tronQrCode = $this->qrcodes->generate($tron_array['address']);

        NinepayTransactionsModel::create([
            'app_id'            =>  $customer->app_id,
            'txn'               =>  $eth_array['id'],
            'customer_id'	    =>  $customer->id,
            'amount'	        =>  $validated['amount'],
            'payment_status'	=>  "PENDING"
        ]);

        // Return the data as a JSON response
        $QRs = [
            'ethQrCode' => $ethQrCode,
            'tronQrCode' => $tronQrCode,
            'ethAddress' => $eth_array['address'],
            'tronAddress' => $tron_array['address'],
        ];

        return view('customer.topup.form', compact('QRs'));
    }
}
