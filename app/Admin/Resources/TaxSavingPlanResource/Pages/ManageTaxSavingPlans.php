<?php

namespace App\Admin\Resources\TaxSavingPlanResource\Pages;

use App\Admin\Resources\TaxSavingPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTaxSavingPlans extends ManageRecords
{
    protected static string $resource = TaxSavingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
