<?php

namespace App\Filament\Widgets;

use App\Models\TransactionFlight;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TransactionFlightOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            stat::make('Total Transaction', TransactionFlight::query()->count()),
            stat::make('Total Ammount (Pending)', 'Rp.'. number_format(TransactionFlight::query()->where('payment_status', 'pending')->sum('grandtotal'), 0, ',', '.')),
            stat::make('Total Ammount (Paid)', 'Rp.'. number_format(TransactionFlight::query()->where('payment_status', 'paid')->sum('grandtotal'), 0, ',', '.')),


        ];
    }
}
