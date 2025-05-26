<?php

namespace App\Admin\Resources;

use App\Admin\Resources\LoanResource\Pages;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationGroup = 'Financial Accounts';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('loan_provider')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('principal_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('emi_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_emis')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('emis_paid')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('next_emi_due')
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
                Tables\Columns\TextColumn::make('loan_provider')
                    ->searchable(),
                Tables\Columns\TextColumn::make('principal_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emi_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_emis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emis_paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_emi_due')
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
            'index' => Pages\ManageLoans::route('/'),
        ];
    }
}
