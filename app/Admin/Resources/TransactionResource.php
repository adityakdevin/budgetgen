<?php

namespace App\Admin\Resources;

use App\Admin\Resources\TransactionResource\Pages;
use App\Enums\PaymentFrequency;
use App\Enums\PaymentMode;
use App\Enums\Status;
use App\Enums\TransactionType;
use App\Models\Category;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Select::make('type')
                        ->options(TransactionType::class)
                        ->required(),
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->createOptionForm(CategoryResource::getFormFields())
                        ->required()
                        ->live(),
                    Forms\Components\Select::make('subcategory_id')
                        ->relationship('subcategory', 'name')
                        ->createOptionForm(CategoryResource::getFormFields())
                        ->options(fn (Forms\Get $get) => $get('category_id')
                            ? Category::where('parent_id', $get('category_id'))
                                ->pluck('name', 'id')
                            : []),
                ]),
                Forms\Components\TextInput::make('amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()
                    ->required(),
                Forms\Components\DateTimePicker::make('transaction_date')
                    ->native(false)
                    ->default(now())
                    ->required(),
                Forms\Components\Select::make('payment_mode')
                    ->options(PaymentMode::class),
                Forms\Components\Select::make('status')
                    ->options(Status::class)
                    ->required(),
                Forms\Components\Toggle::make('is_recurring')
                    ->live()
                    ->required(),
                Forms\Components\Select::make('recurring_frequency')
                    ->options(PaymentFrequency::class)
                    ->visible(fn (Forms\Get $get) => $get('is_recurring')),
                Forms\Components\TagsInput::make('tags')->columnSpanFull(),
                Forms\Components\RichEditor::make('note')->columnSpanFull(),
                Forms\Components\FileUpload::make('attachment_path')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subcategory_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('counterparty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_mode')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_recurring')
                    ->boolean(),
                Tables\Columns\TextColumn::make('recurring_frequency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attachment_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linked_entity_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linked_entity_id')
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
            'index' => Pages\ManageTransactions::route('/'),
        ];
    }
}
