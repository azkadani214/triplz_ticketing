<?php

namespace App\Repositories;

use App\Models\Airport;
use App\Interfaces\AirportRepositoryInterface;

class AirportRepository implements AirportRepositoryInterface
{
    public function getAllAirport()
    {
        return Airport::all();
    }

    public function getAirportsBySlug($slug)
    {
        return Airport::where('slug', $slug)->first;
    }

    public function getAirportsByIataCode($iataCode)
    {
        return Airport::where('iata_code', $iataCode)->first;
    }
}
