<?php

namespace App\Admin\Resources\TransactionResource\Pages;

use App\Admin\Resources\TransactionResource;
use App\Enums\CategoryType;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageTransactions extends ManageRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

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
}
