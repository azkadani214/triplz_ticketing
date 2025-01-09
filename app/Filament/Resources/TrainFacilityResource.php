<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainFacilityResource\Pages;
use App\Filament\Resources\TrainFacilityResource\RelationManagers;
use App\Models\TrainFacility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainFacilityResource extends Resource
{
    protected static ?string $model = TrainFacility::class;

    protected static ?string $navigationGroup = 'Kereta Api';


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
            'index' => Pages\ListTrainFacilities::route('/'),
            'create' => Pages\CreateTrainFacility::route('/create'),
            'edit' => Pages\EditTrainFacility::route('/{record}/edit'),
        ];
    }
}
