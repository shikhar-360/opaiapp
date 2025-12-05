<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagesModel extends Model
{
    protected $table = 'app_packages';

    protected $fillable = [
        'app_id',
        'plan_code',
        'amount',
        'roi_percent',
        'status',
    ];

    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id');
    }
}
