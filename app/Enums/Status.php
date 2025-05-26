<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel
{
    case CLEARED = 'cleared';
    case PENDING = 'pending';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
    case SCHEDULED = 'scheduled';

    public function getLabel(): string
    {
        return match ($this) {
            self::CLEARED => 'Cleared',
            self::PENDING => 'Pending',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
            self::SCHEDULED => 'Scheduled',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CLEARED => 'text-green-500',
            self::PENDING => 'text-yellow-500',
            self::FAILED => 'text-red-500',
            self::REFUNDED => 'text-blue-500',
            self::SCHEDULED => 'text-gray-500',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CLEARED => 'heroicon-o-check-circle',
            self::PENDING => 'heroicon-o-clock',
            self::FAILED => 'heroicon-o-x-circle',
            self::REFUNDED => 'heroicon-o-arrow-uturn-left',
            self::SCHEDULED => 'heroicon-o-calendar',
        };
    }
}
