<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NinepayTransactionsModel extends Model
{
    protected $table = "ninepay_transactions";

    public const PAYMENT_STATUS_PENDING     = 'pending';
    public const PAYMENT_STATUS_SUCCESS     = 'success';
    public const PAYMENT_STATUS_FAILED      = 'failed';
    public const PAYMENT_STATUS_UNDERPAID   = 'underpaid';
    public const PAYMENT_STATUS_CANCEL      = 'cancel';
    
    protected $fillable = [
        'app_id',
        'customer_id',
        'amount',
        'fees_amount',
        'received_amount',
        'chain',
        'currency',
        'payment_status',
        'transaction_id',
        'eth_9pay_json',
        'tron_9pay_json',
        'payment_address',
        'network_type',
        'network_name',
        'remaining_amount',
    ];
    

}
