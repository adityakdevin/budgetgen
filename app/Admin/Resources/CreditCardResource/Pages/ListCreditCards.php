<?php

namespace App\Admin\Resources\CreditCardResource\Pages;

use App\Admin\Resources\CreditCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCreditCards extends ListRecords
{
    protected static string $resource = CreditCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
