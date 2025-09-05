<?php

declare(strict_types=1);

namespace App\Admin\Resources\TaxSavingPlans;

use App\Admin\Resources\TaxSavingPlans\Pages\ManageTaxSavingPlans;
use App\Models\TaxSavingPlan;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class TaxSavingPlanResource extends Resource
{
    protected static ?string $model = TaxSavingPlan::class;

    protected static string|UnitEnum|null $navigationGroup = 'Categories & Budgets';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('plan_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('invested_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('eligible_deduction')
                    ->required()
                    ->numeric(),
                TextInput::make('financial_year')
                    ->required()
                    ->numeric(),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('plan_name')
                    ->searchable(),
                TextColumn::make('invested_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('eligible_deduction')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('financial_year')
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
            'index' => ManageTaxSavingPlans::route('/'),
        ];
    }
}
