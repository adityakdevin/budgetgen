<?php

declare(strict_types=1);

namespace App\Admin\Resources\Categories;

use App\Admin\Resources\Categories\Pages\ManageCategories;
use App\Enums\CategoryType;
use App\Models\Category;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|UnitEnum|null $navigationGroup = 'Categories & Budgets';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(self::getFormFields());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('parent.name')
                    ->visible(fn ($livewire): bool => $livewire->activeTab === 'subcategories')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCategories::route('/'),
        ];
    }

    public static function getFormFields(): array
    {
        return [
            Select::make('parent_id')
                ->relationship('parent', 'name', modifyQueryUsing: fn ($query) => $query->whereNull('parent_id'))
                ->default(session('last_parent_category_id')),
            Select::make('type')
                ->options(CategoryType::class)
                ->required()
                ->default('expense'),
            TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true, modifyRuleUsing: fn ($rule, Get $get) => $rule->where('parent_id', $get('parent_id')))
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }
}
