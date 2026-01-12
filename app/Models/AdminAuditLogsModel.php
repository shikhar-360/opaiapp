<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Observers\AdminAuditObserver;

class AdminAuditLogsModel extends Model
{
    use HasFactory;

    protected $table = 'admin_audit_logs';

    protected $fillable = [
        'admin_id',
        'app_id',
        'action',
        'model',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    protected static function booted()
    {
        static::observe(AdminAuditObserver::class);
    }
}
