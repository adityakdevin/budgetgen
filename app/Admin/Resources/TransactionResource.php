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
use Filament\Support\Enums\MaxWidth;
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
                    Forms\Components\Select::make('type')->options(TransactionType::class)->required()->live(),
                    Forms\Components\Select::make('category_id')
                        ->required()->live()
                        ->relationship('category', 'name', modifyQueryUsing: fn ($query) => $query->whereNull('parent_id'))
                        ->createOptionForm(CategoryResource::getFormFields())
                        ->options(fn (Forms\Get $get) => $get('type')
                            ? Category::where('type', $get('type'))
                                ->whereNull('parent_id')
                                ->pluck('name', 'id')
                            : []),
                    Forms\Components\Select::make('subcategory_id')
                        ->relationship('subcategory', 'name', modifyQueryUsing: fn ($query) => $query->whereNotNull('parent_id'))
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
                Forms\Components\DateTimePicker::make('transaction_date')->native(false)->default(now())
                    ->required(),
                Forms\Components\Select::make('payment_mode')
                    ->options(PaymentMode::class),
                Forms\Components\Select::make('status')
                    ->options([
                        Status::PENDING->value => Status::PENDING->getLabel(),
                        Status::COMPLETED->value => Status::COMPLETED->getLabel(),
                        Status::FAILED->value => Status::FAILED->getLabel(),
                        Status::REFUNDED->value => Status::REFUNDED->getLabel(),
                        Status::SCHEDULED->value => Status::SCHEDULED->getLabel(),
                        Status::IN_PROGRESS->value => Status::IN_PROGRESS->getLabel(),
                        Status::CANCELLED->value => Status::CANCELLED->getLabel(),
                    ])
                    ->default(Status::COMPLETED)
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
                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subcategory.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment_mode')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_recurring')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('recurring_frequency')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('type')->multiple()->options(TransactionType::class),
                Tables\Filters\SelectFilter::make('status')->multiple()->options(Status::class),
                Tables\Filters\SelectFilter::make('category')->attribute('category_id')->multiple()
                    ->relationship('category', 'name')->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('subcategory')->attribute('subcategory_id')
                    ->relationship('subcategory', 'name')->searchable()
                    ->preload(),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)->filtersFormWidth(MaxWidth::FourExtraLarge)
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTransactions::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TransactionResource\Widgets\StatsOverview::class,
        ];
    }
}
