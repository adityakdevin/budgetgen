<?php

declare(strict_types=1);

namespace App\Admin\Resources\Investments;

use App\Admin\Resources\Investments\Pages\ManageInvestments;
use App\Enums\InvestmentMode;
use App\Enums\InvestmentType;
use App\Enums\PaymentFrequency;
use App\Enums\TaxSection;
use App\Models\Investment;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class InvestmentResource extends Resource
{
    protected static ?string $model = Investment::class;

    protected static string|UnitEnum|null $navigationGroup = 'Financial Accounts';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('provider')->required()->maxLength(255),
                Select::make('investment_type')->options(InvestmentType::class)->required(),
                Select::make('mode')->options(InvestmentMode::class)->required(),
                Select::make('frequency')->options(PaymentFrequency::class)->required(),
                Select::make('tax_section')->options(TaxSection::class)->required()->default(TaxSection::NONE),
                Select::make('risk_level')->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])->default('medium'),
                TextInput::make('account_no')->maxLength(255),
                TextInput::make('amount_invested')->required()->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric(),
                TextInput::make('current_value')->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric(),
                TextInput::make('expected_return_rate')->numeric()->suffix('%'),
                DatePicker::make('start_date')->required(),
                DatePicker::make('maturity_date')->native(false),
                Select::make('goal_id')->relationship('goal', 'name')
                    ->preload()->searchable(),
                TagsInput::make('tags')->placeholder('Add tags')
                    ->columnSpanFull()
                    ->helperText('Use enter to separate tags.'),
                RichEditor::make('note')->columnSpanFull(),
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
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('tax_section')
                    ->searchable(),
                TextColumn::make('risk_level')
                    ->searchable(),
                TextColumn::make('goal_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_auto_trackable')
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
            'index' => ManageInvestments::route('/'),
        ];
    }
}
