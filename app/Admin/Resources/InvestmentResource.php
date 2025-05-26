<?php

namespace App\Admin\Resources;

use App\Admin\Resources\InvestmentResource\Pages;
use App\Enums\InvestmentMode;
use App\Enums\InvestmentType;
use App\Enums\PaymentFrequency;
use App\Models\Investment;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvestmentResource extends Resource
{
    protected static ?string $model = Investment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('provider')
                    ->maxLength(255),
                Grid::make(3)->schema([
                    Select::make('investment_type')
                        ->options(InvestmentType::class)
                        ->required(),
                    Select::make('mode')
                        ->options(InvestmentMode::class)
                        ->required(),
                    Select::make('frequency')
                        ->options(PaymentFrequency::class)
                        ->required(),
                ]),
                TextInput::make('account_no')
                    ->maxLength(255),
                TextInput::make('amount_invested')
                    ->required()
                    ->maxLength(255),
                TextInput::make('current_value')
                    ->maxLength(255),
                TextInput::make('expected_return_rate')
                    ->numeric(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('maturity_date'),
                Toggle::make('is_active')
                    ->default(true)
                    ->required(),
                RichEditor::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('investment_type')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('provider')
                    ->searchable(),
                TextColumn::make('account_no')
                    ->searchable(),
                TextColumn::make('amount_invested')
                    ->searchable(),
                TextColumn::make('current_value')
                    ->searchable(),
                TextColumn::make('expected_return_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('maturity_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('mode')
                    ->searchable(),
                TextColumn::make('frequency')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ManageInvestments::route('/'),
        ];
    }
}
