<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CategoryType: string implements HasLabel
{
    case INCOME = 'income';
    case EXPENSE = 'expense';
    case INVESTMENT = 'investment';
    case DEBT = 'debt';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::INCOME => 'Income',
            self::EXPENSE => 'Expense',
            self::INVESTMENT => 'Investment',
            self::DEBT => 'Debt',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::INCOME => 'plus-circle',
            self::EXPENSE => 'minus-circle',
            self::INVESTMENT => 'chart-line',
            self::DEBT => 'exclamation-triangle',
        };
    }
}
