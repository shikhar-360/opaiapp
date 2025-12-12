<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeDepositPackagesModel extends Model
{
    protected $table = 'free_deposit_packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'app_id',
        'package_id',
        'customer_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function app()
    {
        return $this->belongsTo(AppsModel::class, 'app_id');
    }

    public function package()
    {
        return $this->belongsTo(PackagesModel::class, 'package_id');
    }

    public function customer()
    {
        return $this->belongsTo(CustomersModel::class, 'customer_id');
    }
}
