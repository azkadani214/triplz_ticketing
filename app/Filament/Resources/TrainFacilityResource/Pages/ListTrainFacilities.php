<?php

namespace App\Filament\Resources\TrainFacilityResource\Pages;

use App\Filament\Resources\TrainFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrainFacilities extends ListRecords
{
    protected static string $resource = TrainFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
