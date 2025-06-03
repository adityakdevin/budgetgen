<?php

namespace App\Admin\Resources\CreditCardResource\Pages;

use App\Admin\Resources\CreditCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreditCard extends EditRecord
{
    protected static string $resource = CreditCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
