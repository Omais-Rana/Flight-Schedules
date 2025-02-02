<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:5000/get-flight-data');
        $flights = $response->json();
        return view('index', compact('flights'));
    }
}
