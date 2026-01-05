<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\NinepayTransactionsModel;
use App\Models\CustomerWithdrawsModel;
use App\Models\CustomersModel;

use App\Services\Payment\NinePayService;

class WebhooksController extends Controller
{
    protected $ninepays;

    public function __construct(NinePayService $ninepay)
    {
        $this->ninepays = $ninepay;
    }

    public function topupWebhook(Request $request)
    {
        $validatedData = $request->validate([
            'auth'             => 'required|string|min:10',
        ]);

        $newRequest = $validatedData['auth'];
        $newRequest = str_replace("806a7c4ac4e0133b5a90af9008738851", "", $newRequest);
        $newRequest = str_replace("203eb5fde9dbf86421903bb84fde4e03", "", $newRequest);
        $decodedString = base64_decode($newRequest);
        $explodeString = explode("+", $decodedString);

        Log::info('9 Pay listener attempted topupWebhook:'.$validatedData['auth']);

        $transaction_hash = trim($explodeString['0']); //0xd0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482495a263a366
        $amount_nofee = trim($explodeString['1']); //11  // full amount
        $amount_afterfee = trim($explodeString['2']); //9 // Net amount
        $invoice_id = trim($explodeString['3']); // INV43456789 
        $network_type = trim($explodeString['4']); //bsc-testnet
        // $customer_id = 1; //testing
        $amount_received = $amount_nofee; // or  amount_afterfee

        // dd($explodeString, $transaction_hash, $amount_nofee, $amount_afterfee, $invoice_id, $network_type, $amount_received );

        if (!is_numeric($amount_nofee) || $amount_nofee <= 0) {
            return response()->json(['error' => 'Invalid amount_withoutfee'], 400);
        }

        if (!is_numeric($amount_afterfee) || $amount_afterfee <= 0) {
            return response()->json(['error' => 'Invalid amount_afterfee'], 400);
        }

        if ($amount_afterfee > $amount_nofee) {
            return response()->json(['error' => 'amount_afterfee cannot be greater than amount_withoutfee'], 400);
        }

        $allowed_networks = ['bsc-testnet', 'bsc-mainnet', 'polygon', 'matic', 'eth', 'eth-goerli', 'bsc'];

        if (!in_array($network_type, $allowed_networks)) {
            return response()->json(['error' => 'Unsupported network'], 400);
        }

        // dd($explodeString, $transaction_hash, $amount_nofee, $amount_afterfee, $invoice_id, $network_type, $amount_received );

        $txn = NinepayTransactionsModel::where('transaction_id', $invoice_id)->first();
        // dd($txn);
        if (!$txn) 
        {
            Log::error('Ninepay transaction not found', [
                'invoice_id' => $invoice_id,
                'amount_received' => $amount_received,
                'payload' => request()->all(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Transaction'
            ], 404);
        }

        $this->ninepays->topupReceived($txn->customer_id, $amount_received, $invoice_id, $transaction_hash, $amount_afterfee);

        // dd($topup_response);
    }

    public function topupCheckStatus($txnid)
    {
        $txn = NinepayTransactionsModel::where('transaction_id', $txnid)->first();

        if (!$txn) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid request'
            ], 404);
        }

        $totalPayable = (float)$txn->amount + (float)$txn->fees_amount;

        return response()->json([
            'status'           => 'success',
            'payment_status'   => $txn->payment_status,
            'amount'           => $totalPayable,
            'received_amount'  => (float)$txn->received_amount,
            'pending_amount'   => (float)$txn->remaining_amount,
            // 'is_paid'          => ($txn->remaining_amount <= 0)
            'is_paid'          => (
                                    (float)$txn->remaining_amount <= 0
                                    && (float)$txn->received_amount >= $totalPayable
                                ) ? 1 : 0,
        ]);
    }


    public function getPendingWithdraw(Request $request)
    {
        $withdrawtxn = CustomerWithdrawsModel::where('transaction_status', 'pending')->whereNull('transaction_id')->first();

        if (!$withdrawtxn) {
            return response()->json([
                'status' => 'error',
                'message' => 'No pending request'
            ], 404);
        }

        $customer = CustomersModel::where('id', $withdrawtxn->customer_id)->first();

        if($customer->wallet_address)
        {
            return response()->json([
                'status'           => 'success',
                'wallet_address'   => $customer->wallet_address,
                'amount'           => $withdrawtxn->amount,
                'request_id'       => $withdrawtxn->id
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'No data'
            ], 404);
        }
    }

    public function postSuccessWithdraw (Request $request)
    {
        return true;
    }
}
