<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'loan_provider',
        'principal_amount',
        'emi_amount',
        'total_emis',
        'emis_paid',
        'next_emi_due',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'next_emi_due' => 'date',
        ];
    }
}
