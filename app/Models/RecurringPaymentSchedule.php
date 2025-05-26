<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringPaymentSchedule extends Model
{
    protected $fillable = [
        'recurring_payment_id',
        'due_date',
        'amount',
        'paid',
    ];

    public function recurringPayment(): BelongsTo
    {
        return $this->belongsTo(RecurringPayment::class);
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'paid' => 'boolean',
        ];
    }
}
