<?php

declare(strict_types=1);

namespace App\Admin\Resources\Insurances\Pages;

use App\Admin\Resources\Insurances\InsuranceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

final class ManageInsurances extends ManageRecords
{
    protected static string $resource = InsuranceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
