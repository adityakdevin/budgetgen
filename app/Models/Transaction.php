<?php

namespace App\Models;

use App\Enums\PaymentFrequency;
use App\Enums\PaymentMode;
use App\Enums\Status;
use App\Enums\TransactionType;
use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'type',
        'amount',
        'transaction_date',
        'counterparty',
        'payment_mode',
        'note',
        'is_recurring',
        'recurring_frequency',
        'attachment_path',
        'status',
        'tags',
        'linked_entity_type',
        'linked_entity_id',
    ];

    protected array $moneyFields = [
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'transaction_date' => 'datetime',
            'type' => TransactionType::class,
            'payment_mode' => PaymentMode::class,
            'recurring_frequency' => PaymentFrequency::class,
            'status' => Status::class,
            'amount' => 'integer',
            'is_recurring' => 'boolean',
            'tags' => 'json',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id', 'subcategory_id');
    }

    public function linkedEntity(): BelongsTo
    {
        return $this->morphTo();
    }
}
