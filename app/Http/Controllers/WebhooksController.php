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
            'auth'             => 'required|string|min:10',
        ]);

        $newRequest = $validatedData['auth'];
        $newRequest = str_replace("806a7c4ac4e0133b5a90af9008738851", "", $newRequest);
        $newRequest = str_replace("203eb5fde9dbf86421903bb84fde4e03", "", $newRequest);
        $decodedString = base64_decode($newRequest);
        $explodeString = explode("+", $decodedString);

        $transaction_hash = trim($explodeString['0']); //0xd0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482495a263a366
        $amount_nofee = trim($explodeString['1']); //100 (without fee or full amount)
        $amount_afterfee = trim($explodeString['2']); //99 (after fee)
        $invoice_id = trim($explodeString['3']); // INV43456789 
        $network_type = trim($explodeString['4']); //bsc-testnet
        $customer_id = 11; //testing
        $amount_received = $amount_nofee; // or  amount_afterfee

        if (!is_numeric($amount_nofee) || $amount_nofee <= 0) {
            return response()->json(['error' => 'Invalid amount_withoutfee'], 400);
        }

        if (!is_numeric($amount_afterfee) || $amount_afterfee <= 0) {
            return response()->json(['error' => 'Invalid amount_afterfee'], 400);
        }

        if ($amount_afterfee > $amount_nofee) {
            return response()->json(['error' => 'amount_afterfee cannot be greater than amount_withoutfee'], 400);
        }

        $allowed_networks = ['bsc-testnet', 'bsc-mainnet', 'polygon', 'matic', 'eth', 'eth-goerli'];

        if (!in_array($network_type, $allowed_networks)) {
            return response()->json(['error' => 'Unsupported network'], 400);
        }

        // dd($transaction_hash, $amount_nofee, $amount_afterfee, $invoice_id, $network_type, $customer_id, $amount_received);


        $topup_response = $this->ninepays->topupReceived($customer_id, $amount_received, $invoice_id, $transaction_hash);

        dd($topup_response);
    }
}
