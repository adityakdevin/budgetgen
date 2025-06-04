<?php

declare(strict_types=1);

namespace App\Admin\Resources\TaxSavingPlanResource\Pages;

use App\Admin\Resources\TaxSavingPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

final class ManageTaxSavingPlans extends ManageRecords
{
    protected static string $resource = TaxSavingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
