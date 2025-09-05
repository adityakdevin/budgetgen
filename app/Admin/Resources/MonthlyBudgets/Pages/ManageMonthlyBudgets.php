<?php

declare(strict_types=1);

namespace App\Admin\Resources\MonthlyBudgets\Pages;

use App\Admin\Resources\MonthlyBudgets\MonthlyBudgetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

final class ManageMonthlyBudgets extends ManageRecords
{
    protected static string $resource = MonthlyBudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
