<?php

declare(strict_types=1);

namespace App\Admin\Resources\TransactionResource\Widgets;

use App\Enums\CategoryType;
use App\Enums\Status;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

final class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Income', Number::currency($this->getTotalAmount(CategoryType::INCOME), precision: 0))
                ->description('All-time recorded income')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Total Expenses', Number::currency($this->getTotalAmount(CategoryType::EXPENSE), precision: 0))
                ->description('Total money spent')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),

            Stat::make('Total Investments', Number::currency($this->getTotalAmount(CategoryType::INVESTMENT), precision: 0))
                ->description('Total invested so far')
                ->icon('heroicon-o-chart-bar')
                ->color('info'),

            Stat::make('Total Debts', Number::currency($this->getTotalAmount(CategoryType::DEBT, Status::PENDING), precision: 0))
                ->description('Loans, EMIs, Credit Dues')
                ->icon('heroicon-o-credit-card')
                ->color('warning'),
        ];
    }

    private function getTotalAmount($type, $status = null): float
    {
        $row = DB::table('transactions')
            ->where('type', $type)
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->selectRaw('SUM(amount) / 100 as total')
            ->first('total');

        return $row ? (float) $row->total : 0.0;
    }
}
