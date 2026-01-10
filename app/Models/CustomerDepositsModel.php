<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CustomerDepositsModel extends Model
{
    protected $table = "customer_deposits";

    public const PAYMENT_STATUS_PENDING     = 'pending';
    public const PAYMENT_STATUS_SUCCESS     = 'success';
    public const PAYMENT_STATUS_FAILED      = 'failed';
    
    public const TRANSACTION_PREFIX_FREE   = 'freepackage';
    public const TRANSACTION_PREFIX_PAID   = 'deposit';

    protected $fillable = [
        'app_id',
        'customer_id',
        'package_id',
        'amount',
        'transaction_id',
        'payment_status',
        'is_free_deposit',
        'coin_price',
        'tokens'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function package() {
        return $this->belongsTo(PackagesModel::class, 'package_id');
    }

    public function customer() {
        return $this->belongsTo(CustomersModel::class);
    }

    public function earnings() {
        return $this->hasMany(CustomerEarningDetailsModel::class); //, 'reference_id'
    }

    public function getDepositdateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
