<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'txn'              => 'required|numeric|min:3',
            'auth'             => 'required|string|min:10',
            'transaction_hash' => 'required|string|unique:ninepay_transactions,transaction_hash', // Ensure hash is unique immediately
            'amount'           => 'required|numeric|min:0',
            'usdt_amount'      => 'required|numeric|min:0',
            'user_id'          => 'required|integer|exists:customers,id', // Ensure user exists
            'network_type'     => 'required|string',
        ]);

        // $newRequest = $validatedData['auth'];
        // $newRequest = str_replace("806a7c4ac4e0133b5a90af9008738851", "", $newRequest);
        // $newRequest = str_replace("203eb5fde9dbf86421903bb84fde4e03", "", $newRequest);
        // $decodedString = base64_decode($newRequest);
        // $explodeString = explode("+", $decodedString);

        // $transaction_hash = trim($explodeString['0']);
        // $amount = trim($explodeString['1']);
        // $usdt_amount = trim($explodeString['2']);
        // $user_id = trim($explodeString['3']);
        // $network_type = trim($explodeString['4']);

        

        $txn = $validatedData['txn'];
        $customerId = $validatedData['user_id'];
        $amountReceived = (float)$validatedData['amount'];
        $transaction_hash = $validatedData['transaction_hash'];

        $topup_response = $this->ninepays->topupReceived($request, $customerId, $amountReceived, $txn, $transaction_hash);

        dd($topup_response);
    }
}
