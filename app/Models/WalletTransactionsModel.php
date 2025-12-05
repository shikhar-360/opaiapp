<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransactionsModel extends Model
{
    use HasFactory;

    protected $table = 'wallet_transactions';

    protected $fillable = [
        'app_id',
        'payer_id',
        'receiver_id',
        'amount',
        'transaction_id',	
        'transaction_type'
    ];

    /**
     * Get the user who paid for the transaction.
     */
    public function payer(): BelongsTo
    {
        return $this->belongsTo(CustomersModel::class, 'payer_id');
    }

    /**
     * Get the user who received the funds.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(CustomersModel::class, 'receiver_id');
    }
}
