<?php

namespace App\Filament\Resources\TransactionFlightResource\Pages;

use App\Filament\Resources\TransactionFlightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionFlight extends EditRecord
{
    protected static string $resource = TransactionFlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
