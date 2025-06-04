<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Insurance extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'insurance_type',
        'provider_name',
        'policy_number',
        'sum_assured',
        'premium_amount',
        'payment_frequency',
        'start_date',
        'maturity_date',
        'vehicle_type',
        'vehicle_number',
        'is_active',
        'note',
    ];

    protected array $moneyFields = [
        'sum_assured',
        'premium_amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
