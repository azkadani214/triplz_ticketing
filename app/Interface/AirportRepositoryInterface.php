<?php

namespace App\Interfaces;

interface AirportRepositoryInterface
{
    public function getAllAirport();
    public function getAirportsBySlug($slug);
    public function getAirportsByIataCode($iataCode);

}
