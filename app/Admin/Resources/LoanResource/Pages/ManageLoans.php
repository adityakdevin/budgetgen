<?php

declare(strict_types=1);

namespace App\Admin\Resources\LoanResource\Pages;

use App\Admin\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

final class ManageLoans extends ManageRecords
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
