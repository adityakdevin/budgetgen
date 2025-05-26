<?php

namespace App\Admin\Resources\SavingsGoalResource\Pages;

use App\Admin\Resources\SavingsGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSavingsGoals extends ManageRecords
{
    protected static string $resource = SavingsGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
