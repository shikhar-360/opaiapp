<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotesModel extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'app_id',
        'voter_id', 
        'sponsor_id',
        'voted_for',
    ];

    
}