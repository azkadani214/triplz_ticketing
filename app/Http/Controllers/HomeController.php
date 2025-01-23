<?php

namespace App\Http\Controllers;

use App\Interfaces\AirportRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private AirportRepositoryInterface $airportRepository;

    public function __construct(AirportRepositoryInterface $airportRepository)
    {
        $this->airportRepository = $airportRepository;
    }

    public function index()
    {
        // Perbaikan 1: Hapus $ tambahan di $this->$airportRepository
        // Perbaikan 2: getAllAirport() bukan getAllAirpots()
        $airports = $this->airportRepository->getAllAirport();

        return view('pages.home', compact('airports'));
    }
}
