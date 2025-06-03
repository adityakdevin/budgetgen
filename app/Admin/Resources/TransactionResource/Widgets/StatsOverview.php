<?php

namespace App\Admin\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Income', '₹'.number_format(
                Transaction::where('type', 'income')->sum('amount')
            ))
                ->description('All-time recorded income')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Total Expenses', '₹'.number_format(
                Transaction::where('type', 'expense')->sum('amount')
            ))
                ->description('Total money spent')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),

            Stat::make('Total Investments', '₹'.number_format(
                Transaction::where('type', 'investment')->sum('amount')
            ))
                ->description('Total invested so far')
                ->icon('heroicon-o-chart-bar')
                ->color('info'),

            Stat::make('Total Debts', '₹'.number_format(
                Transaction::where('type', 'debt')->sum('amount')
            ))
                ->description('Loans, EMIs, Credit Dues')
                ->icon('heroicon-o-credit-card')
                ->color('warning'),
        ];
    }
}
