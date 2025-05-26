<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentFrequency: string implements HasLabel
{
    case Daily = 'daily';
    case Monthly = 'monthly';
    case Quarterly = 'quarterly';
    case HalfYearly = 'half_yearly';
    case Yearly = 'yearly';

    public function getLabel(): string
    {
        return match ($this) {
            self::Daily => 'Daily',
            self::Monthly => 'Monthly',
            self::Quarterly => 'Quarterly',
            self::HalfYearly => 'Half Yearly',
            self::Yearly => 'Yearly',
        };
    }
}
