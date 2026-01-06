<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerWithdrawsModel extends Model
{
    protected $table = 'customer_withdraws';

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
    ];

    public function customer()
    {
        return $this->belongsTo(CustomersModel::class, 'customer_id');
    }

    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id');
    }
}
