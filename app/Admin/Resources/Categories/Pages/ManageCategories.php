<?php

declare(strict_types=1);

namespace App\Admin\Resources\Categories\Pages;

use Filament\Schemas\Components\Tabs\Tab;
use App\Admin\Resources\Categories\CategoryResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

final class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    public function getTabs(): array
    {
        return [
            'categories' => Tab::make()
                ->label('Parent Categories')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('parent_id')),
            'subcategories' => Tab::make()
                ->label('Sub Categories')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('parent_id')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->after(function (Category $record): void {
                    Session::put('last_parent_category_id', $record->parent_id);
                }),
        ];
    }
}
