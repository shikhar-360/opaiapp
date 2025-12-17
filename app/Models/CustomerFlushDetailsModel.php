<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFlushDetailsModel extends Model
{
    protected $table = 'customer_flush_details';

    protected $fillable = [
        'app_id',
        'upline_id',
        'reference_id',
        'reference_amount',
        'flush_amount',
        'flush_level',
        'reason',
    ];
}
