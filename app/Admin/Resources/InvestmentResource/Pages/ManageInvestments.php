<?php

declare(strict_types=1);

namespace App\Admin\Resources\InvestmentResource\Pages;

use App\Admin\Resources\InvestmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

final class ManageInvestments extends ManageRecords
{
    protected static string $resource = InvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
