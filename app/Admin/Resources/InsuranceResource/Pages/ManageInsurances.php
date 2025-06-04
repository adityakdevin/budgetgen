<?php

declare(strict_types=1);

namespace App\Admin\Resources\InsuranceResource\Pages;

use App\Admin\Resources\InsuranceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

final class ManageInsurances extends ManageRecords
{
    protected static string $resource = InsuranceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
