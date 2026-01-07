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
        'leadership_rank',
        'leadership_points',
        'leadership_champions_rank',
        'telegram_username',
        'iswallet_editable',
        'isphone_editable',
        'champions_point',
        'profile_image',
        'promotion_status',
        'direct_ids',
        'active_direct_ids',
        'isFreePackage',
        'actual_level_id',
        'isWithdrawAssigned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
        'created_at' => 'datetime',
        // 'promotion_status' => 'array',
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

    protected static function booted()
    {
        /*static::creating(function ($customer) {
            if (empty($customer->referral_code)) 
            {
                $customer->referral_code = self::generateUniqueReferralCode($customer->app_id);
            }
        });*/

        static::created(function ($customer) {
            // Only generate if not already set
            if (empty($customer->referral_code)) {

                $customer->referral_code = self::generateUniqueReferralCode(
                    $customer->app_id,
                    $customer->id   // ✅ ID is available here
                );

                // Prevent infinite loop
                $customer->saveQuietly();
            }
        });
    }

    private static function generateUniqueReferralCode($appId, int $id): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        do {
            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[random_int(0, strlen($characters) - 1)];
            }
        } while (self::where('referral_code', $code)->exists());

        return $appId.$id.$code;
    }

    public function leadershipIncome()
    {
        return $this->hasOne(AppLeadershipIncomeModel::class, 'id', 'leadership_rank');
    }

    public function leadershipChampionsIncome()
    {
        return $this->hasOne(AppLeadershipChampionsIncomeModel::class, 'id', 'leadership_champions_rank');
    }
    public function customerDeposits()
    {
        return $this->hasMany(CustomerDepositsModel::class, 'customer_id', 'id');
    }

    public function downlines()
    {
        return $this->hasMany(CustomersModel::class, 'sponsor_id');
    }

    public function customerSettings()
    {
        return $this->hasOne(CustomerSettingsModel::class, 'customer_id', 'id');
    }
}
