<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMoneyCasts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class RecurringPaymentSchedule extends Model
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

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'linked_entity');
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'paid' => 'boolean',
        ];
    }
}
