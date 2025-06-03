<?php

namespace App\Admin\Resources\TransactionResource\Pages;

use App\Admin\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    public static function getWidgets(): array
    {
        return [
            TransactionResource\Widgets\StatsOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
