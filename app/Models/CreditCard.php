<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditCard extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'credit_limit',
        'amount_due',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
