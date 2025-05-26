<?php

namespace App\Admin\Resources;

use App\Admin\Resources\SavingsGoalResource\Pages;
use App\Models\Goal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SavingsGoalResource extends Resource
{
    protected static ?string $model = Goal::class;

    protected static ?string $navigationGroup = 'Categories & Budgets';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('goal_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('target_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('saved_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('target_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('goal_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saved_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('target_date')
                    ->date()
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
            'index' => Pages\ManageSavingsGoals::route('/'),
        ];
    }
}
