<?php
// app/Services/P2PTransferService.php

namespace App\Services;

use App\Models\CustomersModel;
use App\Traits\ManagesUserHierarchy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;

use App\Models\WalletTransactionsModel;

class P2PTransferService
{
    use ManagesUserHierarchy;

    /**
     * Handle the P2P wallet transfer process.
     *
     * @param Customer $payer The user initiating the transfer (the "payee" in your prompt's terms)
     * @param string $receiverWalletAddress The wallet address of the recipient
     * @param float $amount The amount to transfer
     * @throws Exception
     */
    public function transferToTeamMember(CustomersModel $payer, string $receiverWalletAddress, float $amount)
    {
        // 1. Validate the amount
        if ($amount <= 0) {
            return response()->json([
                'status'  => false,
                'message' => 'Transfer amount must be positive.'
            ], 401);
        }

        // 2. Find the receiver
        $receiver = CustomersModel::where('wallet_address', $receiverWalletAddress)->first();

        if (!$receiver) {
            return response()->json([
                'status'  => false,
                'message' => 'Receiver wallet address not found.'
            ], 401);
        }

        if ($payer->id === $receiver->id) {
            return response()->json([
                'status'  => false,
                'message' => 'Cannot transfer funds to yourself.'
            ], 401);
        }

        // 3. Check if the receiver is in the payer's downline
        if (!$this->isReceiverInDownline($payer->id, $receiver->id)) {
            return response()->json([
                'status'  => false,
                'message' => 'The recipient is not in your downline structure.'
            ], 401);
        }
        
        // 4. Check if the payer has sufficient balance
        if ($payer->balance < $amount) {
            // return response()->json([
            //     'status'  => false,
            //     'message' => 'Insufficient wallet balance.'
            // ], 401);
        }

        $transactionString = Str::random(4);
        $transaction_id = "P2PTRANS-".$transactionString."-".$payer->id."-".$receiver->id;

        // 5. Perform the DB operations using a transaction
        return DB::transaction(function () use ($payer, $receiver, $amount, $transaction_id) {
            
            // Debit the Payer
            // $payer->decrement('balance', $amount);

            // Credit the Receiver
            // $receiver->increment('balance', $amount);

            // Log the transaction (insert into wallet_transactions table)

            $insert_array = [
                                'app_id'        => $payer->app_id,
                                'payer_id'      => $payer->id,
                                'receiver_id'   => $receiver->id,
                                'amount'        => $amount,
                                'transaction_id'=> $transaction_id,
                                'transaction_type' => 'P2PTRANSFER',
                                'created_at'    => now(),
                                'updated_at'    => now(),
            ];
            WalletTransactionsModel::create($insert_array);
            unset($insert_array['payer_id'], $insert_array['receiver_id'], $insert_array['updated_at']);
            return [
                'status' => true,
                'message' => 'P2P Transfer successfull',
                'data' => $insert_array
            ];

        });
    }

    /**
     * Checks if a potential receiver ID exists within the payer's downline.
     */
    private function isReceiverInDownline(int $payerId, int $receiverId): bool
    {
        // We use the recursive function defined previously:
        $downlineIds = $this->getRecursiveTeamIds($payerId); 
        
        return in_array($receiverId, $downlineIds);
    }
}
