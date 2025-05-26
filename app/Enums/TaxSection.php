<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TaxSection: string implements HasLabel
{
    case eightyC = '80C';
    case eightyD = '80D';
    case none = 'None';

    public function getLabel(): string
    {
        return $this->value;
    }
}
