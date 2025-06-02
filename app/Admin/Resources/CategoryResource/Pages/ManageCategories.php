<?php

namespace App\Admin\Resources\CategoryResource\Pages;

use App\Admin\Resources\CategoryResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function (Category $record) {
                    Session::put('last_parent_category_id', $record->parent_id);
                }),
        ];
    }

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
}
