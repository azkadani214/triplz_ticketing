<?php

namespace App\Filament\Resources\TransactionTrainResource\Pages;

use App\Filament\Resources\TransactionTrainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionTrains extends ListRecords
{
    protected static string $resource = TransactionTrainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
