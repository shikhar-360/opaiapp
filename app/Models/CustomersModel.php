<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CustomersModel extends Authenticatable
{
    use Notifiable;

    protected $table = "customers";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'app_id',
        'wallet_address',
        'status',
        'referral_code',
        'sponsor_id',
        'team_ids',
        'level_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id');
    }
    
    public function sponsor()
    {
        return $this->belongsTo(CustomersModel::class, 'sponsor_id', 'id');
    }
    
    public function referrals()
    {
        return $this->hasMany(CustomersModel::class, 'sponsor_id');
    }
}
