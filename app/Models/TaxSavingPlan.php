<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class TaxSavingPlan extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'plan_name',
        'invested_amount',
        'eligible_deduction',
        'financial_year',
        'note',
    ];

    protected array $moneyFields = [
        'invested_amount',
        'eligible_deduction',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'financial_year' => 'integer',
        ];
    }
}
