<?php

declare(strict_types=1);

namespace App\Admin\Resources\Transactions\Pages;

use App\Admin\Resources\Transactions\TransactionResource;
use App\Admin\Resources\Transactions\Widgets\StatsOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
