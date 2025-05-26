<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentFrequency: string implements HasLabel
{
    case OneTime = 'one_time';
    case Daily = 'daily';
    case Monthly = 'monthly';
    case Quarterly = 'quarterly';
    case HalfYearly = 'half_yearly';
    case Yearly = 'yearly';

    public function getLabel(): string
    {
        return match ($this) {
            self::OneTime => 'One Time',
            self::Daily => 'Daily',
            self::Monthly => 'Monthly',
            self::Quarterly => 'Quarterly',
            self::HalfYearly => 'Half Yearly',
            self::Yearly => 'Yearly',
        };
    }
}
