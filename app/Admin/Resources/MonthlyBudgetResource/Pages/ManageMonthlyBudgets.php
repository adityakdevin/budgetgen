<?php

declare(strict_types=1);

namespace App\Admin\Resources\MonthlyBudgetResource\Pages;

use App\Admin\Resources\MonthlyBudgetResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

final class ManageMonthlyBudgets extends ManageRecords
{
    protected static string $resource = MonthlyBudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
