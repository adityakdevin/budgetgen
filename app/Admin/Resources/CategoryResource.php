<?php

declare(strict_types=1);

namespace App\Admin\Resources;

use App\Admin\Resources\CategoryResource\Pages\ManageCategories;
use App\Enums\CategoryType;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Categories & Budgets';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getFormFields());
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
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
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
