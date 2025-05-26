<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMode: string implements HasLabel
{
    case CASH = 'cash';
    case BANK = 'bank';
    case WALLET = 'wallet';
    case CREDIT_CARD = 'credit_card';
    case UPI = 'upi';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::CASH => 'Cash',
            self::BANK => 'Bank Transfer',
            self::WALLET => 'Wallet',
            self::CREDIT_CARD => 'Credit Card',
            self::UPI => 'UPI',
            self::OTHER => 'Other',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CASH => 'heroicon-o-cash',
            self::BANK => 'heroicon-o-bank',
            self::WALLET => 'heroicon-o-wallet',
            self::CREDIT_CARD => 'heroicon-o-credit-card',
            self::UPI => 'heroicon-o-upi',
            self::OTHER => 'heroicon-o-ellipsis-horizontal',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CASH => 'text-yellow-500',
            self::BANK => 'text-blue-500',
            self::WALLET => 'text-green-500',
            self::CREDIT_CARD => 'text-purple-500',
            self::UPI => 'text-pink-500',
            self::OTHER => 'text-gray-500',
        };
    }
}
