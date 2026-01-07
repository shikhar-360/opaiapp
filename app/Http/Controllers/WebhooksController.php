<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\NinepayTransactionsModel;
use App\Models\CustomerWithdrawsModel;
use App\Models\CustomersModel;

use App\Services\Payment\NinePayService;
use App\Services\WithdrawService;

class WebhooksController extends Controller
{
    protected $ninepays;

    public function __construct(NinePayService $ninepay, WithdrawService $withdrawsvc)
    {
        $this->ninepays = $ninepay;
        $this->withdrawsvc = $withdrawsvc;
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
        Log::info('Get Pending Withdraw1:', $request->all());

        // $withdrawtxn = CustomerWithdrawsModel::where('transaction_status', 'pending')->whereNull('transaction_id')->first();
        $withdrawtxn = CustomerWithdrawsModel::query()
                                                ->join('customers', 'customers.id', '=', 'customer_withdraws.customer_id')
                                                ->where('customer_withdraws.transaction_status', 'pending')
                                                ->whereNull('customer_withdraws.transaction_id')
                                                ->whereNotNull('customers.wallet_address')
                                                ->select('customer_withdraws.*','customers.wallet_address') 
                                                ->first();

        Log::info('Get Pending Withdraw2:', [$withdrawtxn]);

        if (!$withdrawtxn) {
            return response()->json((object)[], 200);
        }

        Log::info('Get Pending Withdraw3:', [
            'status'           => 'success',
            'wallet_address'   => $withdrawtxn->wallet_address,
            'amount'           => $withdrawtxn->amount,
            'request_id'       => $withdrawtxn->id
        ]);

        return response()->json([
            'status'           => 'success',
            'wallet_address'   => $withdrawtxn->wallet_address,
            'amount'           => $withdrawtxn->amount,
            'request_id'       => $withdrawtxn->id
        ]);
    }

    /*public function postSuccessWithdraw (Request $request)
    {
        Log::info('POST Success Withdraw:', $request->all());
        
        $validatedData = $request->validate([
            'request_id'        =>  'required|numeric|min:1',
            'transaction_hash'  =>  'required|string|min:10',
        ]);

        $withdraw_request = CustomerWithdrawsModel::query()
                                                ->join('customers', 'customers.id', '=', 'customer_withdraws.customer_id')
                                                ->where('customer_withdraws.id', $validatedData['request_id'])
                                                ->where('customer_withdraws.transaction_status', 'pending')
                                                ->whereNull('customer_withdraws.transaction_id')
                                                ->whereNotNull('customers.wallet_address')
                                                ->select('customer_withdraws.*','customers.wallet_address') 
                                                ->first();
        if (!$withdraw_request) {
            return response()->json((object)[], 200);
        }

        if ($withdraw_request) {
            $withdraw_request->transaction_status = 'success';
            $withdraw_request->transaction_id     = $validatedData['transaction_hash'];
            $withdraw_request->save();
        }

        return response()->json([
            'success' => true
        ], 200);
    }*/

    public function postSuccessWithdraw (Request $request)
    {
        Log::info('POST Success Withdraw:', $request->all());
        
        $validatedData = $request->validate([
            'request_id'        =>  'required|numeric|min:1',
            'transaction_hash'  =>  'required|string|min:10',
        ]);

        $withdraw_request = CustomerWithdrawsModel::query()
                                                ->join('customers', 'customers.id', '=', 'customer_withdraws.customer_id')
                                                ->where('customer_withdraws.id', $validatedData['request_id'])
                                                ->where('customer_withdraws.transaction_status', 'pending')
                                                ->whereNull('customer_withdraws.transaction_id')
                                                ->whereNotNull('customers.wallet_address')
                                                ->select('customer_withdraws.*','customers.wallet_address') 
                                                ->first();
        if (!$withdraw_request) {
            return response()->json((object)[], 200);
        }

        if ($withdraw_request) {
            // $withdraw_request->transaction_status = 'success';
            // $withdraw_request->transaction_id     = $validatedData['transaction_hash'];
            // $withdraw_request->save();
            $this->withdrawsvc->updateWithdraw($validatedData);
        }

        return response()->json([
            'success' => true
        ], 200);
    }

    // By Nomaan
    function store_user_data(Request $request){
        $countryCode = $request->input('countryCode');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $telegram = $request->input('telegram');
        DB::table('landing_user')->insert([
            'country_code' => $countryCode,
            'name'         => $name,
            'email'        => $email,
            'phone'        => $phone,
            'telegram'     => $telegram,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Data inserted successfully'
        ]);
    }
    function get_all_user_data(){
        $data = DB::table('landing_user')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data inserted successfully',
            'data' => $data
        ]);
    }
    function get_user_data(Request $request){
        $id = $request->input('id');

        $data = DB::table('landing_user')->where('id',$id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data inserted successfully',
            'data' => $data
        ]);
    }
}
