<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
