<?php

namespace App\Models;

use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxSavingPlan extends Model
{
    use HasUserScope;

    protected $fillable = [
        'user_id',
        'plan_name',
        'invested_amount',
        'eligible_deduction',
        'financial_year',
        'note',
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
