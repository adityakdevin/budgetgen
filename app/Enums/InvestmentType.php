<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum InvestmentType: string implements HasLabel
{
    case STOCK = 'stock';
    case BOND = 'bond';
    case REAL_ESTATE = 'real_estate';
    case MUTUAL_FUND = 'mutual_fund';
    case CRYPTOCURRENCY = 'cryptocurrency';
    case INSURANCE = 'insurance';
    case BANK_DEPOSIT = 'bank_deposit';
    case PPF = 'ppf';
    case EPF = 'epf';
    case NPS = 'nps';
    case GOLD = 'gold';
    case OTHER = 'other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::STOCK => 'Stock',
            self::BOND => 'Bond',
            self::REAL_ESTATE => 'Real Estate',
            self::MUTUAL_FUND => 'Mutual Fund',
            self::CRYPTOCURRENCY => 'Cryptocurrency',
            self::INSURANCE => 'Insurance',
            self::BANK_DEPOSIT => 'Bank Deposit',
            self::PPF => 'Public Provident Fund (PPF)',
            self::EPF => 'Employee Provident Fund (EPF)',
            self::NPS => 'National Pension System (NPS)',
            self::GOLD => 'Gold',
            self::OTHER => 'Other',
        };
    }
}
