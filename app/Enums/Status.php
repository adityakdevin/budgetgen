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
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::CLEARED => 'Cleared',
            self::PENDING => 'Pending',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
            self::SCHEDULED => 'Scheduled',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
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
            self::IN_PROGRESS => 'text-blue-600',
            self::COMPLETED => 'text-green-600',
            self::CANCELLED => 'text-gray-400',
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
            self::IN_PROGRESS => 'heroicon-o-arrow-right',
            self::COMPLETED => 'heroicon-o-check',
            self::CANCELLED => 'heroicon-o-x',
        };
    }
}
