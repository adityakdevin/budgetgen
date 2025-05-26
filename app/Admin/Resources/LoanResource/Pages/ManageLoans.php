<?php

namespace App\Admin\Resources\LoanResource\Pages;

use App\Admin\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLoans extends ManageRecords
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
