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

    public function initiateTransaction($customer, $package, $amount)
    {
        $transactionString = Str::random(12);
        return "RAND-".$transactionString;
    }

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
        $ethURL = "https://api.9pay.co/get-eth-wallet/ninepaytest-" . $customer->id . "-" . $customer->referral_code . "/eth";
        // $eth_json = file_get_contents($eth);
        // return $eth_json;
        try 
        {
            $response = Http::get($ethURL);
            if ($response->successful()) {
                return $response->body(); 
            }
            
            return json_encode([
                'status' => false,
                'data' => $response->status()
            ]);
        } 
        catch (\Throwable $e) 
        {
            return json_encode([
                'status' => false,
                'data' => $e
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
                'status' => false,
                'data' => $response->status()
            ]);
        } 
        catch (\Throwable $e) 
        {
            return json_encode([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function topupReceived($request, $customerId, $amountReceived, $txn, $transactionHash)
    {
        $appid = 0;

        DB::transaction(function () use ($customerId, $amountReceived, $txn, $transactionHash) {

            $customer = CustomersModel::where('id',$customerId)->first();

            $appid = $customer->app_id;

            $pendingPayment = NinepayTransactionsModel::where('customer_id', $customerId)
                                                ->where('payment_status', NinepayTransactionsModel::STATUS_PENDING)
                                                ->where('txn', $txn)
                                                ->where('app_id', $customer->app_id)
                                                ->first();

            if ($pendingPayment) {
                
                $currentReceivedAmount = (float)$pendingPayment->received_amount;
                $newTotalAmountReceived = $currentReceivedAmount + (float)$amountReceived;
                $expectedAmount = (float)$pendingPayment->amount;

                $pendingPayment->received_amount = $newTotalAmountReceived;
                $pendingPayment->transaction_hash = $transactionHash;
                
                if ((abs($expectedAmount - $newTotalAmountReceived) < 0.0001))
                {
                    $pendingPayment->payment_status = NinepayTransactionsModel::STATUS_SUCCESS; 
                    $pendingPayment->save(); 

                    $customer->eth_9pay_json = null;
                    $customer->tron_9pay_json = null;
                    $customer->save();
                } 
                else 
                {
                    $pendingPayment->save(); 
                }
            }

            $finance = $this->getCustomerFinance($customerId, $customer->app_id);
            $finance->increment('total_topup', $amountReceived);
            $finance->save();

        });

        $pendingPayment = NinepayTransactionsModel::where('customer_id', $customerId)
                                                ->where('txn', $txn)
                                                ->where('app_id', $appid)
                                                ->first();
        return $request->json($pendingPayment);
    }
}
