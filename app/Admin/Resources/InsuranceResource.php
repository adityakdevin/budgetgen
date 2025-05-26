<?php

namespace App\Admin\Resources;

use App\Admin\Resources\InsuranceResource\Pages;
use App\Enums\InsuranceType;
use App\Enums\PaymentFrequency;
use App\Models\Insurance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InsuranceResource extends Resource
{
    protected static ?string $model = Insurance::class;

    protected static ?string $navigationGroup = 'Financial Accounts';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('insurance_type')
                    ->options(InsuranceType::class)
                    ->required(),
                Forms\Components\TextInput::make('provider_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('policy_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sum_assured')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('premium_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('payment_frequency')
                    ->options(PaymentFrequency::class)
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('maturity_date')
                    ->native(false),
                Forms\Components\TextInput::make('vehicle_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('vehicle_number')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->required(),
                Forms\Components\RichEditor::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('insurance_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provider_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('policy_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sum_assured')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('premium_amount')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_frequency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('maturity_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_type')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_number')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ManageInsurances::route('/'),
        ];
    }
}
