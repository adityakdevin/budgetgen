<?php

declare(strict_types=1);

namespace App\Admin\Resources\TaxSavingPlans\Pages;

use App\Admin\Resources\TaxSavingPlans\TaxSavingPlanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

final class ManageTaxSavingPlans extends ManageRecords
{
    protected static string $resource = TaxSavingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
