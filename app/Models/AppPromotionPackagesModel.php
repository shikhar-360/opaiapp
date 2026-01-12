<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Observers\AdminAuditObserver;

class AppPromotionPackagesModel extends Model
{
    protected $table = 'app_promotion_packages';

    protected $fillable = [
        'app_id',
        'name',
        'total_beneficiaries',
        'directs',
        'package','package_benefits',
        'benefit_levels'
    ];

    protected $casts = [
        'package' => 'array',
        'package_benefits' => 'array',
        'benefit_levels' => 'array',
    ];

    protected static function booted()
    {
        static::observe(AdminAuditObserver::class);
    }
}
