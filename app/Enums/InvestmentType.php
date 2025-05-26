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

    public function getLabel(): ?string
    {
        return match ($this) {
            self::STOCK => 'Stock',
            self::BOND => 'Bond',
            self::REAL_ESTATE => 'Real Estate',
            self::MUTUAL_FUND => 'Mutual Fund',
            self::CRYPTOCURRENCY => 'Cryptocurrency',
            self::INSURANCE => 'Insurance',
        };
    }
}
