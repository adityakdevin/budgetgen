<?php

namespace App\Admin\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transactions', Transaction::count())
                ->label('Total Transactions')
                ->color('primary'),

            Stat::make('Total Amount', Transaction::sum('amount'))
                ->label('Total Amount')
                ->color('success'),
        ];
    }
}
