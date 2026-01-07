<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSettingsModel extends Model
{
    use HasFactory;

    protected $table = "customer_settings";

    protected $fillable = [
        'app_id',
        'customer_id',
        'isP2P',
        'isSelfTransfer',
        'isFreePackage',
        'isWithdraw',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'isP2P'          => 'boolean',
        'isSelfTransfer' => 'boolean',
        'isFreePackage'  => 'boolean',
        'isWithdraw'     => 'boolean',
    ];


}
