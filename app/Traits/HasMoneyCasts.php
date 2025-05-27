<?php

namespace App\Traits;

use App\Casts\MoneyCast;

trait HasMoneyCasts
{
    protected function initializeHasMoneyCasts(): void
    {
        $this->casts = array_merge(
            $this->casts,
            array_map(fn ($field) => MoneyCast::class, array_flip($this->moneyFields()))
        );
    }

    protected function moneyFields(): array
    {
        return property_exists($this, 'moneyFields') ? $this->moneyFields : [];
    }
}
