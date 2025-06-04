<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class RecurringPayment extends Model
{
    use HasMoneyCasts, HasUserScope;

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

    protected array $moneyFields = [
        'amount',
        'total_amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(RecurringPaymentSchedule::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'linked_entity');
    }
}
