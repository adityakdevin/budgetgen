<?php

declare(strict_types=1);

namespace App\Admin\Resources\Transactions;

use App\Admin\Resources\Categories\CategoryResource;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Enums\Width;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Admin\Resources\Transactions\Pages\ManageTransactions;
use App\Admin\Resources\Transactions\Widgets\StatsOverview;
use App\Enums\PaymentFrequency;
use App\Enums\PaymentMode;
use App\Enums\Status;
use App\Enums\TransactionType;
use App\Models\Category;
use App\Models\Transaction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                    Select::make('type')->options(TransactionType::class)->required()->live(),
                    Select::make('category_id')
                        ->required()->live()
                        ->relationship('category', 'name', modifyQueryUsing: fn ($query) => $query->whereNull('parent_id'))
                        ->createOptionForm(CategoryResource::getFormFields())
                        ->options(fn (Get $get) => $get('type')
                            ? Category::where('type', $get('type'))
                                ->whereNull('parent_id')
                                ->pluck('name', 'id')
                            : []),
                    Select::make('subcategory_id')
                        ->relationship('subcategory', 'name', modifyQueryUsing: fn ($query) => $query->whereNotNull('parent_id'))
                        ->createOptionForm(CategoryResource::getFormFields())
                        ->options(fn (Get $get) => $get('category_id')
                            ? Category::where('parent_id', $get('category_id'))
                                ->pluck('name', 'id')
                            : []),
                ]),
                TextInput::make('amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()
                    ->required(),
                DateTimePicker::make('transaction_date')->native(false)->default(now())
                    ->required(),
                Select::make('payment_mode')
                    ->options(PaymentMode::class),
                Select::make('status')
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
                Toggle::make('is_recurring')
                    ->live()
                    ->required(),
                Select::make('recurring_frequency')
                    ->options(PaymentFrequency::class)
                    ->visible(fn (Get $get): mixed => $get('is_recurring')),
                TagsInput::make('tags')->columnSpanFull(),
                RichEditor::make('note')->columnSpanFull(),
                FileUpload::make('attachment_path')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_date')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('amount')
                    ->money('INR')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subcategory.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_mode')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_recurring')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('recurring_frequency')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
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
                SelectFilter::make('type')->multiple()->options(TransactionType::class),
                SelectFilter::make('status')->multiple()->options(Status::class),
                SelectFilter::make('category')->attribute('category_id')->multiple()
                    ->relationship('category', 'name')->searchable()
                    ->preload(),
                SelectFilter::make('subcategory')->attribute('subcategory_id')
                    ->relationship('subcategory', 'name')->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContentCollapsible)->filtersFormWidth(Width::FourExtraLarge)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTransactions::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
