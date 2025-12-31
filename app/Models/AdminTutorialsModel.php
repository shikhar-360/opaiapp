<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTutorialsModel extends Model
{
    use HasFactory;

    protected $table = 'admin_tutorials';

    protected $fillable = [
        'app_id',
        'resource_type',
        'title',
        'sub_title',
        'url',
        'created_by',
    ];
}
