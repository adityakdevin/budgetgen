<?php

namespace App\Models;

use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditCardDues extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'credit_card_id',
        'due_amount',
        'due_date',
        'is_emi',
        'note',
    ];

    protected array $moneyFields = [
        'due_amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creditCard(): BelongsTo
    {
        return $this->belongsTo(CreditCard::class);
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'is_emi' => 'boolean',
        ];
    }
}
