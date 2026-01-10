<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerEarningDetailsModel extends Model
{
    protected $table = "customer_earning_details";

    public const EARNING_TYPE_FLUSH     = 'flush-income';
    public const EARNING_TYPE_REWARD    = 'level-reward';
    
    protected $fillable = [
        'app_id',
	    'customer_id',
	    'reference_id',
	    'reference_amount',
	    'amount_earned',
	    'earning_type',
	    'status',
	    'reference_level',
	    'flush_amount'
    ];

	public function getEarndateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
