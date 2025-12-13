<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLeadershipIncomeModel extends Model
{
    use HasFactory;

    protected $table = 'leadership_income';

    protected $fillable = [
        'app_id',	
        'rank',		
        'team_volume',	
        'points',	
    ];
}
