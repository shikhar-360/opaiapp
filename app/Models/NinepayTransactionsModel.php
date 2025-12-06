<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NinepayTransactionsModel extends Model
{
    protected $table = "ninepay_transactions";

    // Define the constants here:
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAILED = 'failed';
    
    protected $fillable = [
        'app_id',
        'customer_id',
        'amount',
        'fees_amount',
        'received_amount',
        'chain',
        'currency',
        'payment_status',
        'txn'
    ];
    

}
