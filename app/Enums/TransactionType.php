<?php

namespace App\Enums;

enum TransactionType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';
    case Investment = 'investment';
    case Debt = 'debt';

    public function label(): string
    {
        return match ($this) {
            self::INCOME => 'Income',
            self::EXPENSE => 'Expense',
            self::Investment => 'Investment',
            self::Debt => 'Debt',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::INCOME => 'plus-circle',
            self::EXPENSE => 'minus-circle',
            self::Investment => 'chart-line',
            self::Debt => 'hand-holding-usd',
        };
    }
}
