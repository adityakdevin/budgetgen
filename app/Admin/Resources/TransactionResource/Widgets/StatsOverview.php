<?php

namespace App\Admin\Resources\TransactionResource\Widgets;

use App\Enums\CategoryType;
use App\Enums\Status;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Income', Number::currency(
                Transaction::where('type', 'income')->sum('amount'), 'INR', 'en_IN'
            ))
                ->description('All-time recorded income')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Total Expenses', Number::currency(
                Transaction::where('type', 'expense')->sum('amount'), 'INR', 'en_IN'
            ))
                ->description('Total money spent')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),

            Stat::make('Total Investments', Number::currency(
                Transaction::where('type', 'investment')->sum('amount'), 'INR', 'en_IN'
            ))
                ->description('Total invested so far')
                ->icon('heroicon-o-chart-bar')
                ->color('info'),

            Stat::make('Total Debts', Number::currency(
                Transaction::where(['type' => CategoryType::DEBT, 'status' => Status::PENDING])->sum('amount'), 'INR', 'en_IN'
            ))
                ->description('Loans, EMIs, Credit Dues')
                ->icon('heroicon-o-credit-card')
                ->color('warning'),
        ];
    }
}
