<?php
namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NinePayService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.9pay.base_url');
        $this->apiKey  = config('services.9pay.api_key');
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
}
