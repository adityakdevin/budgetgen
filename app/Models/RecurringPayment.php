<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringPayment extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'amount',
        'tenure_months',
        'total_amount',
        'start_date',
        'end_date',
        'auto_debit',
        'linked_credit_card_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
