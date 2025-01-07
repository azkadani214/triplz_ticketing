<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionFlightResource\Pages;
use App\Filament\Resources\TransactionFlightResource\RelationManagers;
use App\Models\TransactionFlight;
use App\Models\TransactionFlights;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionFlightResource extends Resource
{
    protected static ?string $model = TransactionFlight::class;

    protected static ?string $navigationGroup = 'Transaksi & Keuangan'; // Tambahkan ini

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListTransactionFlights::route('/'),
            'create' => Pages\CreateTransactionFlight::route('/create'),
            'edit' => Pages\EditTransactionFlight::route('/{record}/edit'),
        ];
    }
}
