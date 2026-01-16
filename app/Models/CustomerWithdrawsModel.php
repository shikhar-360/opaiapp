<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CustomerWithdrawsModel extends Model
{
    protected $table = 'customer_withdraws';

    public const TRANSACTION_STATUS_PENDING      = 'pending';
    public const TRANSACTION_STATUS_SUCCESS      = 'success';

    public const TRANSACTION_TYPE_WITHDRAW       = 'withdraw';
    public const TRANSACTION_TYPE_SELFTRANSFER   = 'selftransfer';
    public const TRANSACTION_TYPE_P2PTRANSFER    = 'p2ptransfer';

    protected $fillable = [
        'app_id',   
        'customer_id',  
        'admin_charge', 
        'amount',   
        'admin_charge_amount',  
        'net_amount',   
        'transaction_id',   
        'transaction_status',
        'transaction_type',
        'to_customer',
        'pool_fees',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomersModel::class, 'customer_id');
    }

    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id');
    }

    public function getWithdrawdateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
