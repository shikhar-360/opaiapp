<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class forgotPasswordRequestsModel extends Model
{
    protected $table = 'forgot_password_requests';

    protected $fillable = [
        'user_id',
        'code',
       
    ];
    
}
