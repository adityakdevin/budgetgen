<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CardType: string implements HasLabel
{
    case Visa = 'Visa';
    case MasterCard = 'MasterCard';
    case RuPay = 'RuPay';
    case Other = 'Other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Visa => 'Visa',
            self::MasterCard => 'Master Card',
            self::RuPay => 'RuPay',
            self::Other => 'Other',
        };
    }
}
