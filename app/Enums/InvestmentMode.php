<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum InvestmentMode: string implements HasLabel
{
    case SIP = 'sip';
    case LUMPSUM = 'lumpsum';
    case PREMIUM = 'premium';
    case RD = 'rd';
    case FD = 'fd';
    case OTHERS = 'others';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SIP => 'Systematic Investment Plan (SIP)',
            self::LUMPSUM => 'Lump Sum',
            self::PREMIUM => 'Premium',
            self::RD => 'Recurring Deposit (RD)',
            self::FD => 'Fixed Deposit (FD)',
            self::OTHERS => 'Others',
        };
    }
}
