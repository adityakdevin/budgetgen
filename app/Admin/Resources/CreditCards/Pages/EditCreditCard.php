<?php

declare(strict_types=1);

namespace App\Admin\Resources\CreditCards\Pages;

use App\Admin\Resources\CreditCards\CreditCardResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditCreditCard extends EditRecord
{
    protected static string $resource = CreditCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
