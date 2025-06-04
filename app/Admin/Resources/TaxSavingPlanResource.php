<?php

declare(strict_types=1);

namespace App\Admin\Resources;

use App\Admin\Resources\TaxSavingPlanResource\Pages\ManageTaxSavingPlans;
use App\Models\TaxSavingPlan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class TaxSavingPlanResource extends Resource
{
    protected static ?string $model = TaxSavingPlan::class;

    protected static ?string $navigationGroup = 'Categories & Budgets';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            'index' => ManageTaxSavingPlans::route('/'),
        ];
    }
}
