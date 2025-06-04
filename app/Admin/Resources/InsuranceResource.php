<?php

declare(strict_types=1);

namespace App\Admin\Resources;

use App\Admin\Resources\InsuranceResource\Pages\ManageInsurances;
use App\Enums\InsuranceType;
use App\Enums\PaymentFrequency;
use App\Models\Insurance;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class InsuranceResource extends Resource
{
    protected static ?string $model = Insurance::class;

    protected static ?string $navigationGroup = 'Financial Accounts';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('insurance_type')
                    ->options(InsuranceType::class)
                    ->required(),
                TextInput::make('provider_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('policy_number')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sum_assured')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()->inputMode('decimal')
                    ->minValue(0.1),
                TextInput::make('premium_amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()->inputMode('decimal')
                    ->minValue(0.1),
                Select::make('payment_frequency')
                    ->options(PaymentFrequency::class)
                    ->required(),
                DatePicker::make('start_date')
                    ->native(false)
                    ->required(),
                DatePicker::make('maturity_date')
                    ->native(false),
                TextInput::make('vehicle_type')
                    ->maxLength(255),
                TextInput::make('vehicle_number')
                    ->maxLength(255),
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
                TextColumn::make('insurance_type')
                    ->searchable(),
                TextColumn::make('provider_name')
                    ->searchable(),
                TextColumn::make('policy_number')
                    ->searchable(),
                TextColumn::make('sum_assured')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('premium_amount')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('payment_frequency')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('maturity_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('vehicle_type')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('vehicle_number')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                IconColumn::make('is_active')
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
            'index' => ManageInsurances::route('/'),
        ];
    }
}
