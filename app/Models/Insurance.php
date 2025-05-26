<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Insurance extends Model
{
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
