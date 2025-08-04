<?php

declare(strict_types=1);

namespace App\Traits;

use App\Casts\MoneyCast;

trait HasMoneyCasts
{
    protected function initializeHasMoneyCasts(): void
    {
        $moneyFields = $this->moneyFields();
        foreach ($moneyFields as $field) {
            $this->casts[$field] = MoneyCast::class;
        }
    }

    protected function moneyFields(): array
    {
        return property_exists($this, 'moneyFields') ? $this->moneyFields : [];
    }
}
