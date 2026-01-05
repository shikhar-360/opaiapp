<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerEarningDetailsModel extends Model
{
    protected $table = "customer_earning_details";

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
}
