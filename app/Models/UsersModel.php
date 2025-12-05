<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class UsersModel extends Authenticatable
{
    use HasFactory;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
        'app_id',
        'wallet_address',
        'phone',
        'blocked',
        'role',
        'meta',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'blocked' => 'boolean',
        'meta' => 'array',
    ];

    public function app()
    {
        return $this->belongsTo(AppsModel::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function passwordResetToken()
    {
        return $this->hasOne(PasswordResetToken::class, 'email', 'email');
    }
}
