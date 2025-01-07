<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;
    protected static ?string $navigationGroup = 'Penerbangan'; // Tambahkan ini
    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Informasi Penerbangan')
                        ->schema([
                            Forms\Components\TextInput::make('flight_number')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\Select::make('airline_id')
                                ->relationship('airline', 'name')
                                ->required(),
                        ]),
                    Forms\Components\Wizard\Step::make('Rute Penerbangan')
                        ->schema([
                            Forms\Components\Repeater::make('flight_segments')
                                ->relationship('segments')
                                ->schema([
                                    Forms\Components\TextInput::make('sequence')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\Select::make('airport_id')
                                        ->relationship('airport', 'name')
                                        ->required(),
                                    Forms\Components\DateTimePicker::make('time')
                                        ->required(),
                                ])
                                ->collapsed(false)
                                ->minItems(1),
                        ]),
                    Forms\Components\Wizard\Step::make('Kelas Penerbangan')
                        ->schema([
                            Forms\Components\Repeater::make('flight_classes')
                                ->relationship('classes')
                                ->schema([
                                    Forms\Components\Select::make('class_type')
                                        ->options([
                                            'business' => 'Bisnis',
                                            'economy' => 'Ekonomi',
                                        ])
                                        ->required(),
                                    Forms\Components\TextInput::make('price')
                                        ->required()
                                        ->prefix('IDR')
                                        ->numeric()
                                        ->minValue(0),
                                    Forms\Components\TextInput::make('total_seats')
                                        ->required()
                                        ->numeric()
                                        ->minValue(1)
                                        ->label('Total Kursi'),
                                    Forms\Components\Select::make('facilities')
                                        ->relationship('facilities', 'name')
                                        ->multiple()
                                        ->required(),
                                ])
                                ->minItems(1),
                        ]),
                ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('flight_number'),
            Tables\Columns\TextColumn::make('airline.name'),
            Tables\Columns\TextColumn::make('segments')
                ->label('Route & Duration')
                ->formatStateUsing(function (Flight $record): string {
                    $firstSegment = $record->segments->first();
                    $lastSegment = $record->segments->last();

                    // Pastikan firstSegment dan lastSegment tidak null
                    if (!$firstSegment || !$lastSegment) {
                        return 'N/A';
                    }

                    $route = $firstSegment->airport->iata_code . '-' . $lastSegment->airport->iata_code;
                    $duration = (new \DateTime($firstSegment->time))->format('d F Y H:i') . ' - ' .
                                (new \DateTime($lastSegment->time))->format('d F Y H:i');

                    return $route . ' | ' . $duration;
                }),
        ])
        ->filters([
            // Tambahkan filter jika diperlukan
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
