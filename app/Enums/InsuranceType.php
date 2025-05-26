<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum InsuranceType: string implements HasLabel
{
    case Life = 'life';
    case Health = 'health';
    case Vehicle = 'vehicle';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Life => 'Life Insurance',
            self::Health => 'Health Insurance',
            self::Vehicle => 'Vehicle Insurance',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Life => 'heroicon-o-heart',
            self::Health => 'heroicon-o-hospital',
            self::Vehicle => 'heroicon-o-car',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Life => 'text-red-500',
            self::Health => 'text-green-500',
            self::Vehicle => 'text-blue-500',
        };
    }
}
