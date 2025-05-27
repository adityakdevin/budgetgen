<?php

namespace App\Models;

use App\Enums\GoalType;
use App\Enums\Priority;
use App\Enums\Status;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Goal extends Model
{
    use HasUserScope;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'target_amount',
        'saved_amount',
        'target_date',
        'priority',
        'status',
        'notes',
        'is_active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'target_date' => 'date',
            'status' => Status::class,
            'type' => GoalType::class,
            'priority' => Priority::class,
        ];
    }

    public function contributions(): HasMany
    {
        return $this->hasMany(GoalContribution::class);
    }

    public function getProgressAttribute(): float
    {
        if ($this->target_amount <= 0) {
            return 0;
        }

        return min(100, ($this->saved_amount / $this->target_amount) * 100);
    }
}
