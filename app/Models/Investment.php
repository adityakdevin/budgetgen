<?php

namespace App\Models;

use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investment extends Model
{
    use HasUserScope;

    protected $fillable = [
        'user_id',
        'investment_type',
        'name',
        'amount_invested',
        'current_value',
        'expected_return_rate',
        'start_date',
        'maturity_date',
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
            'start_date' => 'date',
            'maturity_date' => 'date',
            'is_active' => 'boolean',
        ];
    }
}
