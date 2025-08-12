<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\LoanType;
use App\Enums\Status;
use App\Traits\HasMoneyCasts;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Loan extends Model
{
    use HasMoneyCasts, HasUserScope;

    protected $fillable = [
        'user_id',
        'provider',
        'account_no',
        'type',
        'principal_amount',
        'interest_rate',
        'emi_amount',
        'total_emis',
        'emis_paid',
        'start_date',
        'next_emi_due',
        'autopay',
        'status',
        'notes',
    ];

    protected array $moneyFields = [
        'principal_amount',
        'interest_rate',
        'emi_amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getEmiStatusAttribute(): string
    {
        if ($this->emis_paid >= $this->total_emis) {
            return 'Completed';
        }

        if ($this->next_emi_due < now()) {
            return 'Overdue';
        }

        return 'Pending';
    }

    public function getRemainingEmisAttribute(): int
    {
        return $this->total_emis - $this->emis_paid;
    }

    public function getTotalPaidAttribute(): int
    {
        return $this->emis_paid * $this->emi_amount;
    }

    public function getTotalDueAttribute(): int
    {
        return ($this->total_emis - $this->emis_paid) * $this->emi_amount;
    }

    protected function casts(): array
    {
        return [
            'next_emi_due' => 'date',
            'start_date' => 'date',
            'autopay' => 'boolean',
            'status' => Status::class,
            'type' => LoanType::class,
        ];
    }
}
