<?php

namespace App\Filament\Resources\TransactionFlightResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\TransactionFlightOverview;
use App\Filament\Resources\TransactionFlightResource;

class ListTransactionFlights extends ListRecords
{
    protected static string $resource = TransactionFlightResource::class;

    public function getHeaderWidgets(): array{
        return[
            TransactionFlightOverview::class
        ];
    }



    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

}
