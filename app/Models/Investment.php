<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvestmentMode;
use App\Enums\InvestmentType;
use App\Enums\PaymentFrequency;
use App\Enums\TaxSection;
use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Investment extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'investment_type',
        'name',
        'provider',
        'account_no',
        'amount_invested',
        'current_value',
        'expected_return_rate',
        'start_date',
        'maturity_date',
        'mode',
        'frequency',
        'is_active',
        'note',
        'tax_section',
        'risk_level',
        'goal_id',
        'is_auto_trackable',
        'tags',
    ];

    protected array $moneyFields = [
        'amount_invested',
        'current_value',
        'expected_return_rate',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    protected function casts(): array
    {
        return [
            'investment_type' => InvestmentType::class,
            'mode' => InvestmentMode::class,
            'frequency' => PaymentFrequency::class,
            'tax_section' => TaxSection::class,
            'start_date' => 'date',
            'maturity_date' => 'date',
            'is_active' => 'boolean',
            'tags' => 'json',
        ];
    }
}
