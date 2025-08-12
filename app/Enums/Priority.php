<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Priority: string implements HasLabel
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
            self::URGENT => 'Urgent',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::LOW => 'text-green-500',
            self::MEDIUM => 'text-yellow-500',
            self::HIGH => 'text-orange-500',
            self::URGENT => 'text-red-500',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::LOW => 'heroicon-o-arrow-down',
            self::MEDIUM => 'heroicon-o-arrow-right',
            self::HIGH => 'heroicon-o-arrow-up',
            self::URGENT => 'heroicon-o-exclamation-circle',
        };
    }
}
