<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLeadershipPackagesModel extends Model
{
    use HasFactory;

    protected $table = "app_leadership_packages";

    protected $fillable = [
        'app_id', 
        'rank',
        'volume',
        'points',
    ];

    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id');
    }

}
