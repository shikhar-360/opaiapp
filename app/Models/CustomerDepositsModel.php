<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDepositsModel extends Model
{
    protected $table = "customer_deposits";

    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAILED = 'failed';
    public const STATUS_UNDERPAID = 'underpaid';

    protected $fillable = [
        'app_id',
        'customer_id',
        'package_id',
        'amount',
        'roi_percent',
        'roi_earned',
        'transaction_id',
        'payment_status',
        'is_free_deposit',
        'coin_price',
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
}
