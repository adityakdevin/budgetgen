<?php

namespace App\Admin\Resources\InvestmentResource\Pages;

use App\Admin\Resources\InvestmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInvestments extends ManageRecords
{
    protected static string $resource = InvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
