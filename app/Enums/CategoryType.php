<?php

namespace App\Enums;

enum CategoryType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';
    case INVESTMENT = 'investment';

    public function label(): string
    {
        return match ($this) {
            self::INCOME => 'Income',
            self::EXPENSE => 'Expense',
            self::INVESTMENT => 'Investment',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::INCOME => 'plus-circle',
            self::EXPENSE => 'minus-circle',
            self::INVESTMENT => 'chart-line',
        };
    }
}
