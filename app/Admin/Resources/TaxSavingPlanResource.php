<?php

declare(strict_types=1);

namespace App\Admin\Resources;

use App\Admin\Resources\TaxSavingPlanResource\Pages;
use App\Models\TaxSavingPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('plan_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('invested_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('eligible_deduction')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('financial_year')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('invested_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('eligible_deduction')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('financial_year')
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
            'index' => Pages\ManageTaxSavingPlans::route('/'),
        ];
    }
}
