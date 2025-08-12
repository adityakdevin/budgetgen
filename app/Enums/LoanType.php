<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LoanType: string implements HasLabel
{
    case Personal = 'personal';
    case Car = 'car';
    case Wallet = 'wallet';
    case Las = 'las';
    case Education = 'education';
    case CreditCard = 'credit_card';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::Personal => 'Personal Loan',
            self::Car => 'Car Loan',
            self::Wallet => 'Wallet Loan',
            self::Las => 'Loan Against Securities',
            self::Education => 'Education Loan',
            self::CreditCard => 'Credit Card Loan',
            self::Other => 'Other Loan',
        };
    }
}
