<?php

namespace App\Models;

use App\Traits\HasMoneyCasts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringPaymentSchedule extends Model
{
    use HasMoneyCasts;

    protected $fillable = [
        'recurring_payment_id',
        'due_date',
        'amount',
        'paid',
    ];

    protected array $moneyFields = [
        'amount',
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
