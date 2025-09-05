<?php

declare(strict_types=1);

namespace App\Admin\Resources\CreditCards;

use App\Admin\Resources\CreditCards\Pages\CreateCreditCard;
use App\Admin\Resources\CreditCards\Pages\EditCreditCard;
use App\Admin\Resources\CreditCards\Pages\ListCreditCards;
use App\Admin\Resources\CreditCards\RelationManagers\DuesRelationManager;
use App\Enums\CardType;
use App\Models\CreditCard;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class CreditCardResource extends Resource
{
    protected static ?string $model = CreditCard::class;

    protected static string|UnitEnum|null $navigationGroup = 'Financial Accounts';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bank_name')
                    ->required()
                    ->maxLength(255),
                Select::make('card_type')
                    ->options(CardType::class)
                    ->required(),
                TextInput::make('card_number')
                    ->mask(RawJs::make(<<<'JS'
                        $input.startsWith('34') || $input.startsWith('37') ? '9999 999999 99999' : '9999 9999 9999 9999'
                    JS))
                    ->maxLength(255),

                TextInput::make('total_limit')
                    ->required()
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()->inputMode('decimal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bank_name')
                    ->searchable(),
                TextColumn::make('card_type')
                    ->searchable(),
                TextColumn::make('card_number')
                    ->searchable(),
                TextColumn::make('total_limit')
                    ->money('INR')
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

    public static function getRelations(): array
    {
        return [
            DuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCreditCards::route('/'),
            'create' => CreateCreditCard::route('/create'),
            'edit' => EditCreditCard::route('/{record}/edit'),
        ];
    }
}
