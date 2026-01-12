<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Observers\AdminAuditObserver;

class AppLeadershipChampionsIncomeModel extends Model
{
    use HasFactory;

    protected $table = 'app_champions_income_plan';

    protected $fillable = [
        'app_id',	
        'rank',	
        'directs',	
        'team_volume',	
        'points',	
    ];

    protected static function booted()
    {
        static::observe(AdminAuditObserver::class);
    }
}
