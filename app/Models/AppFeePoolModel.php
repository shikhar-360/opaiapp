<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppFeePoolModel extends Model
{
    use HasFactory;

    protected $table = "app_fee_pool";

    protected $fillable =[
        'app_id',
        'network_name',
        'total_pool',
        'reserved_amount',
        'used_amount',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
