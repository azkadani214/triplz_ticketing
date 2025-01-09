<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionFlightResource\Pages;
use App\Filament\Resources\TransactionFlightResource\RelationManagers;
use App\Models\TransactionFlight;
use App\Models\TransactionFlights;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class TransactionFlightResource extends Resource
{
    protected static ?string $model = TransactionFlight::class;

    protected static ?string $navigationGroup = 'Transaksi & Keuangan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Umum')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('flight_id')
                            ->relationship('flight', 'name')
                            ->required()
                            ->searchable(),

                        Forms\Components\Select::make('flight_class_id')
                            ->relationship('flightClass', 'name')
                            ->required()
                            ->searchable(),
                    ]),

                Forms\Components\Section::make('Informasi Pelanggan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),

                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required(),

                        Forms\Components\Repeater::make('passengers')
                            ->relationship('passengers')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),

                                Forms\Components\DatePicker::make('date_of_birth')
                                    ->required(),

                                Forms\Components\TextInput::make('nationality')
                                    ->required(),

                                Forms\Components\Select::make('flight_seat_id')
                                    ->relationship('flightSeat', 'name')
                                    ->required()
                                    ->searchable(),
                            ])
                            ->columns(2),
                    ]),

                Forms\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->required(),

                        Forms\Components\Select::make('promo_code_id')
                            ->relationship('promoCode', 'code')
                            ->searchable()
                            ->nullable(),

                        Forms\Components\TextInput::make('subtotal')
                            ->numeric()
                            ->disabled(),

                        Forms\Components\TextInput::make('grandtotal')
                            ->numeric()
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flight.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_passengers'),
                Tables\Columns\TextColumn::make('promoCode.code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'failed' => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('subtotal')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('grandtotal')
                    ->money('IDR'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTransactionFlights::route('/'),
            'create' => Pages\CreateTransactionFlight::route('/create'),
            'edit' => Pages\EditTransactionFlight::route('/{record}/edit'),
        ];
    }
}
