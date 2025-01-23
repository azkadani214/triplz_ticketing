<?php

namespace App\Repositories;

use App\Interfaces\AirportRepositoryInterface;
use App\Models\Airport; // Assuming you have an Airport model

class AirportRepository implements AirportRepositoryInterface

{
    public function getAllAirport()
    {
        return Airport::all();
    }

    public function getAirportsBySlug($slug)
    {
        return Airport::where('slug', $slug)->first();
    }

    public function getAirportsByIataCode($iataCode)
    {
        return Airport::where('iata_code', $iataCode)->first();
    }
}
