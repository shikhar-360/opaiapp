<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Observers\AdminAuditObserver;

class VotesModel extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'app_id',
        'voter_id', 
        'sponsor_id',
        'voted_for',
    ];

    public function sponsor()
    {
        return $this->belongsTo(CustomersModel::class, 'sponsor_id');
    }

    protected static function booted()
    {
        static::observe(AdminAuditObserver::class);
    }
}