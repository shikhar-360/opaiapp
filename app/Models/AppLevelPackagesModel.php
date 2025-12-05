<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLevelPackagesModel extends Model
{
    use HasFactory;

    protected $table = 'app_level_packages';

    protected $fillable = [
        'app_id',
        'level',
        'directs',
        'reward'
    ];

    /**
     * Relationship: Each level package belongs to an app
     */
    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id', 'id');
    }
}
