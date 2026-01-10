<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFinancialsModel extends Model
{
    protected $table = 'customer_financials';

    protected $fillable = [
        'app_id',
        'customer_id',
        'total_deposit',
        'total_income',
        'total_withdraws',
        'capping_limit',
        'total_tokens',
    ];
}
