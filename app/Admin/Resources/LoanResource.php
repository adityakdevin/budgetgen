<?php

namespace App\Admin\Resources;

use App\Admin\Resources\LoanResource\Pages;
use App\Enums\LoanType;
use App\Enums\Status;
use App\Models\Loan;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationGroup = 'Financial Accounts';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('provider')
                    ->required()
                    ->string()
                    ->maxLength(191),
                Forms\Components\TextInput::make('account_no')
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options(LoanType::class)
                    ->required(),
                Forms\Components\TextInput::make('principal_amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()->inputMode('decimal')
                    ->minValue(0.1)
                    ->required(),
                Forms\Components\TextInput::make('interest_rate')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->helperText('Annual, reducing balance'),
                Forms\Components\TextInput::make('emi_amount')
                    ->label('EMI Amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->prefixIcon('heroicon-o-currency-rupee')
                    ->stripCharacters(',')->numeric()->inputMode('decimal')
                    ->minValue(0.1)
                    ->required()
                    ->helperText(fn (Forms\Get $get) => $get('total_emis')
                        ? "{$get('emis_paid')} / {$get('total_emis')} EMIs paid"
                        : null),
                Forms\Components\TextInput::make('total_emis')
                    ->label('Total EMIs')
                    ->reactive()
                    ->numeric(),
                Forms\Components\TextInput::make('emis_paid')
                    ->label('EMIs Paid')
                    ->numeric()
                    ->reactive()
                    ->default(0),
                Forms\Components\DatePicker::make('start_date')
                    ->native(false)
                    ->default(today())
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('next_emi_due', Carbon::parse($state)->addMonth()))
                    ->required(),
                Forms\Components\DatePicker::make('next_emi_due')
                    ->label('Next EMI Due')
                    ->native(false)
                    ->default(today()->addMonth())
                    ->required(),
                Forms\Components\Toggle::make('autopay')
                    ->label('Auto Pay')
                    ->default(false)
                    ->helperText('Enable to automatically pay EMIs on due date'),
                Forms\Components\Select::make('status')
                    ->options(Status::class)
                    ->required()
                    ->default('active'),
                Forms\Components\RichEditor::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provider')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('principal_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interest_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emi_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_emis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emis_paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_emi_due')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('autopay')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
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
            'index' => Pages\ManageLoans::route('/'),
        ];
    }
}
