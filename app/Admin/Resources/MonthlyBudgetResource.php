<?php

namespace App\Admin\Resources;

use App\Admin\Resources\MonthlyBudgetResource\Pages;
use App\Models\MonthlyBudget;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Unique;

class MonthlyBudgetResource extends Resource
{
    protected static ?string $model = MonthlyBudget::class;

    protected static ?string $navigationGroup = 'Categories & Budgets';

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name', modifyQueryUsing: fn ($query) => $query->whereNull('parent_id'))
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()
                    ->required(),
                Forms\Components\Select::make('month')
                    ->options(collect(range(1, 12))
                        ->mapWithKeys(fn ($m) => [$m => now()->month($m)->format('F')])
                    )
                    ->default(now()->month)
                    ->required(),
                Forms\Components\Select::make('year')
                    ->options(collect(range(now()->year, now()->year + 3))
                        ->mapWithKeys(fn ($y) => [$y => $y])
                    )
                    ->default(now()->year)
                    ->required()
                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, Forms\Get $get) {
                        return $rule->where('category_id', $get('category_id'))->where('month', $get('month'));
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('month')
                    ->formatStateUsing(
                        fn ($state) => now()->month($state)->format('F')
                    )
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMonthlyBudgets::route('/'),
        ];
    }
}
