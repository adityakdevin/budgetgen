<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TaxSection: string implements HasLabel
{
    case EIGHTYC = '80C';
    case EIGHTYD = '80D';
    case NONE = 'None';

    public function getLabel(): string
    {
        return $this->value;
    }
}
