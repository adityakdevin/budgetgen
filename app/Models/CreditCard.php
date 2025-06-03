<?php

namespace App\Models;

use App\Enums\CardType;
use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CreditCard extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'bank_name',
        'card_type',
        'amount_due',
        'total_limit',
        'card_number',
    ];

    protected array $moneyFields = [
        'amount_due',
        'total_limit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'card_type' => CardType::class,
        ];
    }

    public function dues(): HasMany
    {
        return $this->hasMany(CreditCardDues::class);
    }
}
