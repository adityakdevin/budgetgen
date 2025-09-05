<?php

declare(strict_types=1);

namespace App\Admin\Resources\Insurances;

use App\Admin\Resources\Insurances\Pages\ManageInsurances;
use App\Enums\InsuranceType;
use App\Enums\PaymentFrequency;
use App\Models\Insurance;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class InsuranceResource extends Resource
{
    protected static ?string $model = Insurance::class;

    protected static string|UnitEnum|null $navigationGroup = 'Financial Accounts';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            'index' => ManageInsurances::route('/'),
        ];
    }
}
