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
use App\Services\DashboardMatriceService;

class Topup9PayController extends Controller
{
    protected $qrcodes;
    protected $ninepays;
    protected $dashbaord_matrice_services;

    public function __construct(NinePayService $ninepay, QRCodeService $qrcode, DashboardMatriceService $dashbaord_matrice_service)
    {
        $this->ninepays = $ninepay;
        $this->qrcodes = $qrcode;
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
    }

    public function showForm()
    {

        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];
        $customer->myPackages               =   $dashboard_matrics['myPackages'];
        $customer->myFinance                =   $dashboard_matrics['myFinance'];
        $customer['QRs'] = array();

        $pendingTxn = NinepayTransactionsModel::where("customer_id", $customer->id)
                                                ->where("app_id", $customer->app_id)
                                                ->whereIn("payment_status", ['pending', 'underpaid'])
                                                ->latest()
                                                ->first();
        $remaining = 0;
        if ($pendingTxn) 
        {
            $eth_array = json_decode($pendingTxn->eth_9pay_json, true);
            $tron_array = json_decode($pendingTxn->tron_9pay_json, true);

            $ethQrCode = $this->qrcodes->generate($eth_array['address']);
            $tronQrCode = $this->qrcodes->generate($tron_array['address']);

            $remaining = ($pendingTxn->amount + $pendingTxn->fees_amount) - $pendingTxn->received_amount;

            $customer['QRs'] = [
                'ethQrCode'         => $ethQrCode,
                'tronQrCode'        => $tronQrCode,
                'ethAddress'        => $eth_array['address'],
                'tronAddress'       => $tron_array['address'],
                'qrAmount'          => $pendingTxn->amount + $pendingTxn->fees_amount,
                'qrFeesAmount'      => $pendingTxn->fees_amount,
                'qrPendingAmount'   => $remaining,
                'transaction_id'    => $pendingTxn->transaction_id,
            ];
        }
        // dd($customer);
        return view('customer.pay_qr', compact('customer'));
    }

    public function topup(Request $request)
    {
        // dd($request->all());
        $customer = Auth::guard('customer')->user();
        $customer['QRs'] = array();
        if (!$customer) {
            // abort(403, 'Customer not authenticated.');
            return back()->withErrors(['status_code'=>'error', 'message' => 'Customer not authenticated.']);
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
        $qrAmount = 0;
        $qrPendingAmount = 0;
        $transaction_id = '';
        // dd($pendingTxn);

        // If previous transaction exists
        if ($pendingTxn) 
        {
            $remaining = ($pendingTxn->amount + $pendingTxn->fees_amount) - $pendingTxn->received_amount;
            
            if($pendingTxn->received_amount <= 0)
            {
                // Do not create NEW top-up transaction
                $eth_array = json_decode($pendingTxn->eth_9pay_json, true);
                $tron_array = json_decode($pendingTxn->tron_9pay_json, true);

                $ethQrCode = $this->qrcodes->generate($eth_array['address']);
                $tronQrCode = $this->qrcodes->generate($tron_array['address']);

                $qrAmount = $remaining;
                $transaction_id = $pendingTxn->transaction_id;
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

                $qrAmount = $remaining;
                $transaction_id = $pendingTxn->transaction_id;
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
                'coin_amount'   => 'required|numeric|min:5',
                "coinSelect"    => 'required|string|min:3',
                "network_type"  => 'required|string|min:3',
                "network_name"  => 'required|string|min:3',
            ]);    
            
            $transaction_id = "TXN" . $customer->id . Str::random(4);

            // --- ETH Wallet Logic ---
            $ninepay_eth = $this->ninepays->getEthWallet($customer, $transaction_id);
       
            // --- TRON Wallet Logic ---
            $ninepay_tron = $this->ninepays->getTronWallet($customer, $transaction_id);
            
            $ninepay_fee = $this->ninepays->ninePayFee($validated['network_type'], $validated['coin_amount']);

            // Decode the JSON strings into PHP arrays
            $eth_array = json_decode($ninepay_eth, true);
            $tron_array = json_decode($ninepay_tron, true);

            // Basic check to ensure decoding worked and 'address' key exists
            if (!isset($eth_array['address']) || !isset($tron_array['address'])) {
                // return response()->json(['error' => 'Could not retrieve valid wallet addresses.'], 500);
                return back()->withErrors(['status_code'=>'error', 'message' => 'Could not retrieve valid wallet addresses.']);
            }

            // Generate QR codes using your service (make sure generate returns the Base64 URI if used in a view)
            $ethQrCode = $this->qrcodes->generate($eth_array['address']);
            $tronQrCode = $this->qrcodes->generate($tron_array['address']);

            $newTxn = NinepayTransactionsModel::create([
                        'customer_id'     => $customer->id,
                        'app_id'          => $customer->app_id,
                        'amount'          => $validated['coin_amount'],
                        'received_amount' => 0,
                        'payment_status'  => NinepayTransactionsModel::STATUS_PENDING,
                        'payment_address' => $eth_array['address'],
                        'eth_9pay_json'   => $ninepay_eth,
                        'tron_9pay_json'  => $ninepay_tron,
                        'chain'           => $validated['network_type'],
                        'network_type'    => $validated['network_type'],
                        'network_name'    => $validated['network_name'],
                        'currency'        => $validated['coinSelect'],
                        'fees_amount'     => $ninepay_fee,
                        'transaction_id'  => $transaction_id
                    ]);
            
            $qrAmount = $validated['coin_amount'];

            // $transaction_id = "TXN" . $newTxn->id . $customer->id . Str::random(4);
            // $newTxn->update(['transaction_id' => $transaction_id]);
        
        }

        if($ethQrCode || $tronQrCode)
        {
            // Return the data as a JSON response
            $QRs = [
                'ethQrCode'         => $ethQrCode,
                'tronQrCode'        => $tronQrCode,
                'ethAddress'        => $eth_array['address'],
                'tronAddress'       => $tron_array['address'],
                'qrAmount'          => $qrAmount,
                'qrPendingAmount'   => $qrPendingAmount,
                'transaction_id'    => $transaction_id,
            ];
            $customer['QRs'] = $QRs;
            // return view('customer.pay_qr', compact('customer'));
            return redirect()
                    ->route('pay.qr')
                    ->with([
                        'status'  => 'success',
                        'message' => 'Please pay using QR!'
                    ]);
        }
        else{
            return back()->withErrors(['status_code'=>'error', 'message' => 'Some issue occured.']);
        }
    }

    public function topupCancel(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|string|exists:ninepay_transactions,transaction_id',
        ]);
        NinepayTransactionsModel::where('transaction_id', $validated['transaction_id'])
                                    ->update(['payment_status' => NinepayTransactionsModel::STATUS_CANCEL]);
         return redirect()
                    ->route('pay.qr')
                    ->with([
                        'status'  => 'success',
                        'message' => 'Transaction Canceled'
                    ]);
    }

}
