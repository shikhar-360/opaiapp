<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPasswordRequestsModel extends Model
{
    protected $table = 'forgot_password_requests';

    protected $fillable = [
        'customer_id',
        'code',
        'expires_at',
    ];
    
    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
