<?php

declare(strict_types=1);

namespace App\Admin\Resources\TransactionResource\Pages;

use App\Admin\Resources\TransactionResource;
use App\Admin\Resources\TransactionResource\Widgets\StatsOverview;
use App\Enums\CategoryType;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

final class ManageTransactions extends ManageRecords
{
    protected static string $resource = TransactionResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'expenses' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', CategoryType::EXPENSE)),
            'incomes' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', CategoryType::INCOME)),
            'investments' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', CategoryType::INVESTMENT)),
            'debts' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', CategoryType::DEBT)),
        ];
    }

    protected function getHeaderWidgets(): array
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
