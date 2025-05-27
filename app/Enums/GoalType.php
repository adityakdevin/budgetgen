<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum GoalType: string implements HasLabel
{
    case SHORT_TERM = 'Saving';
    case LONG_TERM = 'Investment';
    case DEBT_REPAYMENT = 'Debt Repayment';
    case EMERGENCY_FUND = 'Emergency Fund';
    case RETIREMENT = 'Retirement';
    case EDUCATION = 'Education';
    case TRAVEL = 'Travel';
    case OTHER = 'Other';

    public function getLabel(): string
    {
        return match ($this) {
            self::SHORT_TERM => 'Short Term',
            self::LONG_TERM => 'Long Term',
            self::DEBT_REPAYMENT => 'Debt Repayment',
            self::EMERGENCY_FUND => 'Emergency Fund',
            self::RETIREMENT => 'Retirement',
            self::EDUCATION => 'Education',
            self::TRAVEL => 'Travel',
            self::OTHER => 'Other',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::SHORT_TERM => 'text-blue-500',
            self::LONG_TERM => 'text-green-500',
            self::DEBT_REPAYMENT => 'text-red-500',
            self::EMERGENCY_FUND => 'text-yellow-500',
            self::RETIREMENT => 'text-purple-500',
            self::EDUCATION => 'text-teal-500',
            self::TRAVEL => 'text-orange-500',
            self::OTHER => 'text-gray-500',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::SHORT_TERM => 'heroicon-o-sparkles',
            self::LONG_TERM => 'heroicon-o-chart-bar',
            self::DEBT_REPAYMENT => 'heroicon-o-credit-card',
            self::EMERGENCY_FUND => 'heroicon-o-shield-check',
            self::RETIREMENT => 'heroicon-o-briefcase',
            self::EDUCATION => 'heroicon-o-book-open',
            self::TRAVEL => 'heroicon-o-globe-alt',
            self::OTHER => 'heroicon-o-ellipsis-horizontal',
        };
    }
}
