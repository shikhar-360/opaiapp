<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    /*public function topup(Request $request)
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

        $invoice_number = "INV".$customer->id."".Str::random(4);
        $txn =  NinepayTransactionsModel::create([
                    'app_id'            =>  $customer->app_id,
                    'txn'               =>  $eth_array['id'],
                    'customer_id'	    =>  $customer->id,
                    'amount'	        =>  $validated['amount'],
                    'payment_status'	=>  "PENDING"
                ]);

        $invoice_number = "INV" . $txn->id . $customer->id . Str::random(4);

        $txn->update(['invoice_number' => $invoice_number]);

        // Return the data as a JSON response
        $QRs = [
            'ethQrCode' => $ethQrCode,
            'tronQrCode' => $tronQrCode,
            'ethAddress' => $eth_array['address'],
            'tronAddress' => $tron_array['address'],
        ];

        return view('customer.topup.form', compact('QRs'));
    }*/

    public function topup(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            abort(403, 'Customer not authenticated.');
        }

        // Fetch last pending/underpaid transaction
        $pendingTxn = NinepayTransactionsModel::where("customer_id", $customer->id)
                                                ->where("app_id", $customer->app_id)
                                                ->whereIn("payment_status", ['pending', 'underpaid'])
                                                ->latest()
                                                ->first();

        $eth_array = array();
        $tron_array = array();
        $ethQrCode = '';
        $tronQrCode = '';

        // dd($pendingTxn);

        // If previous transaction exists
        if ($pendingTxn) 
        {
            $remaining = $pendingTxn->amount - $pendingTxn->received_amount;
            // dd($pendingTxn->received_amount, $remaining);
            // Safety check
            // if ($remaining <= 0) 
            // {
            //     $pendingTxn->status = NinepayTransactionsModel::STATUS_SUCCESS;
            // }
            // else

            if($pendingTxn->received_amount <= 0)
            {
                // Do not create NEW top-up transaction
                $eth_array = json_decode($pendingTxn->eth_9pay_json, true);
                $tron_array = json_decode($pendingTxn->tron_9pay_json, true);

                $ethQrCode = $this->qrcodes->generate($eth_array['address']);
                $tronQrCode = $this->qrcodes->generate($tron_array['address']);
            }
            else if($remaining > 0)
            {
                $pendingTxn->payment_status  = NinepayTransactionsModel::STATUS_UNDERPAID;
                $pendingTxn->save();

                // Create NEW top-up transaction with same payment address
                $copyTxn = NinepayTransactionsModel::create([
                    'customer_id'     => $customer->id,
                    'app_id'          => $customer->app_id,
                    'amount'          => $remaining,
                    'received_amount' => 0,
                    'payment_status'  => NinepayTransactionsModel::STATUS_PENDING,
                    'payment_address' => $pendingTxn->payment_address, // REUSE ADDRESS
                    'eth_9pay_json'   => $pendingTxn->eth_9pay_json,         // REUSE QR
                    'tron_9pay_json'  => $pendingTxn->tron_9pay_json,         // REUSE QR
                    'transaction_id'  => $pendingTxn->transaction_id,
                ]);
                // $transaction_id = "TXN" . $copyTxn->id . $customer->id . Str::random(4);
                // $copyTxn->update(['transaction_id' => $transaction_id]);

                $eth_array = json_decode($pendingTxn->eth_9pay_json, true);
                $tron_array = json_decode($pendingTxn->tron_9pay_json, true);

                $ethQrCode = $this->qrcodes->generate($eth_array['address']);
                $tronQrCode = $this->qrcodes->generate($tron_array['address']);
            }
            else
            {
                goto NEWTOPUPREQUEST;
            }
        }
        else
        {
            NEWTOPUPREQUEST:
            $validated = $request->validate([
                'amount'            => 'required|numeric|min:5|max:50',
                // 'fees_amount'       => 'required|numeric',
                // 'received_amount'   => 'required|numeric',
                // 'chain'             => 'required|string',
                // 'currency'          => 'required|string'
            ]);    
        
            // --- ETH Wallet Logic ---
            $ninepay_eth = $this->ninepays->getEthWallet($customer);
       
            // --- TRON Wallet Logic ---
            $ninepay_tron = $this->ninepays->getTronWallet($customer);
            
            // Decode the JSON strings into PHP arrays
            $eth_array = json_decode($ninepay_eth, true);
            $tron_array = json_decode($ninepay_tron, true);
            

            // Basic check to ensure decoding worked and 'address' key exists
            if (!isset($eth_array['address']) || !isset($tron_array['address'])) {
                return response()->json(['error' => 'Could not retrieve valid wallet addresses.'], 500);
            }

            // Generate QR codes using your service (make sure generate returns the Base64 URI if used in a view)
            $ethQrCode = $this->qrcodes->generate($eth_array['address']);
            $tronQrCode = $this->qrcodes->generate($tron_array['address']);

            $newTxn = NinepayTransactionsModel::create([
                        'customer_id'     => $customer->id,
                        'app_id'          => $customer->app_id,
                        'amount'          => $validated['amount'],
                        'received_amount' => 0,
                        'payment_status'  => NinepayTransactionsModel::STATUS_PENDING,
                        'payment_address' => $eth_array['address'],
                        'eth_9pay_json'   => $ninepay_eth,
                        'tron_9pay_json'  => $ninepay_tron
                    ]);
            $transaction_id = "TXN" . $newTxn->id . $customer->id . Str::random(4);
            $newTxn->update(['transaction_id' => $transaction_id]);
        
        }

        if($ethQrCode || $tronQrCode)
        {
            // Return the data as a JSON response
            $QRs = [
                'ethQrCode' => $ethQrCode,
                'tronQrCode' => $tronQrCode,
                'ethAddress' => $eth_array['address'],
                'tronAddress' => $tron_array['address'],
            ];

            return view('customer.topup.form', compact('QRs'));
        }
        else{
            echo "Some issue occured";
        }
    }

}
