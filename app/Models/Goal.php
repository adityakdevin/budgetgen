<?php

namespace App\Models;

use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    use HasUserScope;

    protected $fillable = [
        'user_id',
        'goal_name',
        'target_amount',
        'saved_amount',
        'target_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'target_date' => 'date',
        ];
    }
}
