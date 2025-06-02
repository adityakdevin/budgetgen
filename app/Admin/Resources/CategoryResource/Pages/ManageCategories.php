<?php

namespace App\Admin\Resources\CategoryResource\Pages;

use App\Admin\Resources\CategoryResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
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
}
