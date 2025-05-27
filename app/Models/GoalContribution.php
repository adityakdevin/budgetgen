<?php

namespace App\Models;

use App\Traits\HasMoneyCasts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalContribution extends Model
{
    use HasMoneyCasts;

    protected $fillable = [
        'goal_id',
        'transaction_id',
        'amount',
        'contributed_at',
        'note',
    ];

    protected array $moneyFields = [
        'amount',
    ];

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    protected function casts(): array
    {
        return [
            'contributed_at' => 'date',
        ];
    }
}
