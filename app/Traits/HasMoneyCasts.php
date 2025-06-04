<?php

declare(strict_types=1);

namespace App\Traits;

use App\Casts\MoneyCast;

trait HasMoneyCasts
{
    protected function initializeHasMoneyCasts(): void
    {
        $this->casts = array_merge(
            $this->casts,
            array_map(fn ($field): string => MoneyCast::class, array_flip($this->moneyFields()))
        );
    }

    protected function moneyFields(): array
    {
        return property_exists($this, 'moneyFields') ? $this->moneyFields : [];
    }
}
