<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSupportTicketsModel extends Model
{
    use HasFactory;

    const STATUS_OPEN    = 0;
    const STATUS_REPLIED = 1;
    const STATUS_CLOSED  = 2;
    
    protected $table = 'app_support_tickets';

    protected $fillable = [
        'app_id',	
        'customer_id',	
        'subject',	
        'message',	
        'file',	
        'status',	
        'reply',	
        'replied_at',
    ];

    public static function statusLabels()
    {
        return [
            self::STATUS_OPEN    => 'Open',
            self::STATUS_REPLIED => 'Replied',
            self::STATUS_CLOSED  => 'Closed',
        ];
    }

    public function getStatusTextAttribute()
    {
        return self::statusLabels()[$this->status] ?? 'Unknown';
    }
}
