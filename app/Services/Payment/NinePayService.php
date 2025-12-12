<?php
namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\NinepayTransactionsModel;
use App\Models\CustomersModel;

use App\Traits\ManagesCustomerFinancials;

class NinePayService
{
    protected $baseUrl;
    protected $apiKey;

    use ManagesCustomerFinancials; 

    public function __construct()
    {
        // $this->baseUrl = config('services.9pay.base_url');
        // $this->apiKey  = config('services.9pay.api_key');
    }

    // public function initiateTransaction($customer, $package, $amount)
    // {
    //     $transactionString = Str::random(12);
    //     return "RAND-".$transactionString;
    // }

    public function validateTransaction($txnId)
    {
        // Example (adjust according to real 9Pay API)
        $response = Http::post($this->baseUrl.'/validate', [
            'txn_id' => $txnId,
            'api_key' => $this->apiKey,
        ]);

        if (!$response->successful()) {
            throw new \Exception("9Pay API Error");
        }

        $data = $response->json();

        if ($data['status'] !== 'SUCCESS') {
            throw new \Exception("Transaction not valid or failed.");
        }

        return $data;
    }


    public function getEthWallet($customer)
    {
        $ethURL = "https://api.9pay.co/get-eth-wallet/ninepaytest-INV0123456789-" . $customer->id . "-" . $customer->referral_code . "/eth";
        // $eth_json = file_get_contents($eth);
        // return $eth_json;
        try 
        {
            $response = Http::get($ethURL);
            if ($response->successful()) {
                return $response->body(); 
            }
            
            return json_encode([
                'status' => 'error',
                'message' => $response->status()
            ]);
        } 
        catch (\Throwable $e) 
        {
            return json_encode([
                'status' => 'error',
                'message' => $e
            ]);
        }

    }

    public function getTronWallet($customer)
    {
        $tronURL = "https://api.9pay.co/get-tron-wallet/ninepaytest-" . $customer->id . "-" . $customer->referral_code;
        // $getTron = file_get_contents($tron);
        // return $getTron;
        try 
        {
            $response = Http::get($tronURL);
            if ($response->successful()) {
                return $response->body();
            }
            
            return json_encode([
                'status' => 'error',
                'message' => $response->status()
            ]);
        } 
        catch (\Throwable $e) 
        {
            return json_encode([
                'status' => 'error',
                'message' => $e
            ]);
        }
    }

    public function topupReceived($customerId, $amountReceived, $transactionId, $transactionHash)
    {
        $appid = 0;
        
        // dd($customerId, $amountReceived, $transactionId, $transactionHash);
        $refreshedFinance = array();
        DB::transaction(function () use ($customerId, $amountReceived, $transactionId, $transactionHash) {

            $customer = CustomersModel::where('id',$customerId)->first();

            $appid = $customer->app_id;

            $pendingPayment = NinepayTransactionsModel::where('customer_id', $customerId)
                                                        ->where('payment_status', NinepayTransactionsModel::STATUS_PENDING)
                                                        ->where('transaction_id', $transactionId)
                                                        // ->whereNull('transaction_hash')
                                                        ->where('app_id', $customer->app_id)
                                                        ->first();

            // dd($pendingPayment);

            if ($pendingPayment) {
                
                $currentReceivedAmount = (float)$pendingPayment->received_amount;
                $newTotalAmountReceived = $currentReceivedAmount + (float)$amountReceived;
                $expectedAmount = (float)$pendingPayment->amount;

                $pendingPayment->received_amount = $newTotalAmountReceived;
                $pendingPayment->transaction_hash = $transactionHash;
                
                // dd(abs($expectedAmount),abs($newTotalAmountReceived));
                // dd(abs($expectedAmount), abs($newTotalAmountReceived));
                // if ((abs($expectedAmount - $newTotalAmountReceived) < 0.0001))
                if (abs($expectedAmount) <= abs($newTotalAmountReceived))
                {
                    // dd("1", $pendingPayment);
                    $pendingPayment->payment_status = NinepayTransactionsModel::STATUS_SUCCESS; 
                    $pendingPayment->save(); 

                    $criteria = [
                        'customer_id'    => $customerId,
                        'transaction_id' => $transactionId,
                        'app_id'         => $customer->app_id, 
                        'payment_status' => NinepayTransactionsModel::STATUS_UNDERPAID
                    ];

                    // Define the data you want to update in those records
                    $updateData = [
                        'payment_status'   => NinepayTransactionsModel::STATUS_SUCCESS
                    ];

                    // Perform the mass update
                    NinepayTransactionsModel::where($criteria)->update($updateData);
                } 
                else 
                {
                    $pendingPayment->payment_status = NinepayTransactionsModel::STATUS_UNDERPAID; 
                    // dd("2", $pendingPayment);
                    $pendingPayment->save(); 
                }

                // dd("3", $pendingPayment);

                $finance = $this->getCustomerFinance($customerId, $customer->app_id);
                $finance->increment('total_topup', $amountReceived);
                $finance->save();
            }
        });

    }

    public function ninePayFee($chain, $amount)
    {
        $feeAmount = 5;
        
        if ($chain == 'polygon') {
            if ($amount >= 100) {
                $feeAmount = $amount * 0.5 / 100;
            } else {
                $feeAmount = 0.5;
            }
        }
        else if ($chain == 'tron') {
            if ($amount >= 100) {
                $feeAmount = $amount * 3 / 100;
            } else {
                $feeAmount = 3;
            }
        }
        else if ($chain == 'bsc') {
            if ($amount >= 100) {
                $feeAmount = $amount * 1 / 100;
            } else {
                $feeAmount = 1;
            }
        }
        else if ($chain == 'eth') {
            if ($amount >= 100) {
                $feeAmount = $amount * 5 / 100;
            } else {
                $feeAmount = 5;
            }
        }
        
        return $feeAmount;
        
    }
}
