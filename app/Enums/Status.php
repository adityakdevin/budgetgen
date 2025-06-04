<?php

declare(strict_types=1);

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
    case ACTIVE = 'active';
    case CLOSED = 'closed';
    case DEFAULTED = 'defaulted';

    public static function loanStatus(): array
    {
        return [
            self::ACTIVE,
            self::CLOSED,
            self::DEFAULTED,
        ];
    }

    public static function transactionStatus(): array
    {
        return [
            self::CLEARED,
            self::PENDING,
            self::FAILED,
            self::REFUNDED,
            self::SCHEDULED,
            self::IN_PROGRESS,
            self::COMPLETED,
            self::CANCELLED,
        ];
    }

    public static function recurringPaymentStatus(): array
    {
        return [
            self::ACTIVE,
            self::CANCELLED,
            self::COMPLETED,
        ];
    }

    public static function goalStatus(): array
    {
        return [
            self::ACTIVE,
            self::CANCELLED,
            self::COMPLETED,
        ];
    }

    public static function investmentStatus(): array
    {
        return [
            self::ACTIVE,
            self::CANCELLED,
            self::COMPLETED,
        ];
    }

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
            self::ACTIVE => 'Active',
            self::CLOSED => 'Closed',
            self::DEFAULTED => 'Defaulted',
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
            self::ACTIVE => 'text-green-700',
            self::CLOSED => 'text-gray-800',
            self::DEFAULTED => 'text-red-700',
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
            self::ACTIVE => 'heroicon-o-play',
            self::CLOSED => 'heroicon-o-stop',
            self::DEFAULTED => 'heroicon-o-ban',
        };
    }
}
