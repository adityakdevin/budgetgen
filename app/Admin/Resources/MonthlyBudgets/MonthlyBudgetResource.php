<?php

declare(strict_types=1);

namespace App\Admin\Resources\MonthlyBudgets;

use App\Admin\Resources\MonthlyBudgets\Pages\ManageMonthlyBudgets;
use App\Models\MonthlyBudget;
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
use Filament\Support\RawJs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Unique;
use UnitEnum;

final class MonthlyBudgetResource extends Resource
{
    protected static ?string $model = MonthlyBudget::class;

    protected static string|UnitEnum|null $navigationGroup = 'Categories & Budgets';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wallet';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name', modifyQueryUsing: fn ($query) => $query->whereNull('parent_id'))
                    ->required(),
                TextInput::make('amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()
                    ->required(),
                Select::make('month')
                    ->options(collect(range(1, 12))
                        ->mapWithKeys(fn ($m) => [$m => now()->month($m)->format('F')])
                    )
                    ->default(now()->month)
                    ->required(),
                Select::make('year')
                    ->options(collect(range(now()->year, now()->year + 3))
                        ->mapWithKeys(fn ($y) => [$y => $y])
                    )
                    ->default(now()->year)
                    ->required()
                    ->unique(ignoreRecord: true, modifyRuleUsing: fn (Unique $rule, Get $get) => $rule->where('category_id', $get('category_id'))->where('month', $get('month'))),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('amount')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('month')
                    ->formatStateUsing(
                        fn ($state) => now()->month($state)->format('F')
                    )
                    ->sortable(),
                TextColumn::make('year')
                    ->numeric()
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
            'index' => ManageMonthlyBudgets::route('/'),
        ];
    }
}
