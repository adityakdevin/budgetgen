<?php

declare(strict_types=1);

namespace App\Admin\Resources\CreditCardResource\Pages;

use App\Admin\Resources\CreditCardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListCreditCards extends ListRecords
{
    protected static string $resource = CreditCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
