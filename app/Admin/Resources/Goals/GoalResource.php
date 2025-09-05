<?php

declare(strict_types=1);

namespace App\Admin\Resources\Goals;

use App\Admin\Resources\Goals\Pages\CreateGoal;
use App\Admin\Resources\Goals\Pages\EditGoal;
use App\Admin\Resources\Goals\Pages\ListGoals;
use App\Admin\Resources\Goals\RelationManagers\ContributionsRelationManager;
use App\Enums\GoalType;
use App\Enums\Priority;
use App\Enums\Status;
use App\Models\Goal;
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

final class GoalResource extends Resource
{
    protected static ?string $model = Goal::class;

    protected static string|UnitEnum|null $navigationGroup = 'Categories & Budgets';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options(GoalType::class)
                    ->required(),
                TextInput::make('target_amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()
                    ->required(),
                TextInput::make('saved_amount')
                    ->label('Saved so far')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()
                    ->default(0),
                DatePicker::make('target_date')
                    ->native(false),
                Select::make('priority')
                    ->options(Priority::class)
                    ->required()
                    ->default('medium'),
                Select::make('status')
                    ->options(Status::class)
                    ->required()
                    ->default('in_progress'),
                Toggle::make('is_active')
                    ->required(),
                RichEditor::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('target_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('saved_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('target_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('priority')
                    ->searchable(),
                TextColumn::make('status')
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

    public static function getRelations(): array
    {
        return [
            ContributionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGoals::route('/'),
            'create' => CreateGoal::route('/create'),
            'edit' => EditGoal::route('/{record}/edit'),
        ];
    }
}
