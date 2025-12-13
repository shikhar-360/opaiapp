<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLeadershipChampionsIncomeModel extends Model
{
    use HasFactory;

    protected $table = 'leadership_champions_income';

    protected $fillable = [
        'app_id',	
        'rank',	
        'directs',	
        'team_volume',	
        'points',	
    ];
}
