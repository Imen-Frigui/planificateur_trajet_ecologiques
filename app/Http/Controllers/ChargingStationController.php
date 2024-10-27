<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class ChargingStationController extends Controller
{
    public function index()
    {

        $response = Http::get('http://localhost:9090/charging');

        if ($response->successful()) {
            $chargingStations = $response->json();
    
            return view('chargingStations.index', ['chargingStations' => $chargingStations]);
        } else {
            return view('chargingStations.index', ['chargingStations' => [], 'error' => 'Unable to retrieve charging stations.']);
        }
    }

    public function create()
    {
        return view('chargingStations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'stationType' => 'required|string|max:255',
            'chargingSpeed' => 'required|numeric',
            'fastCharging' => 'required|boolean',
        ]);
        $fastChargingValue = $validatedData['fastCharging'] === '1' ? true : false;

        $response = Http::post('http://localhost:9090/charging', [
            'stationType' => $validatedData['stationType'],
            'chargingSpeed' => $validatedData['chargingSpeed'],
            'fastCharging' => $fastChargingValue,
        ]);

        if ($response->successful()) {
            return redirect()->route('chargingStations.index')->with('success', 'Charging station created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to create charging station.']);
        }
    }
    public function deleteChargingStation(Request $request)
    {
        $stationURI = $request->input('URI');
        
        $response = Http::delete('http://localhost:9090/charging?' . http_build_query([
            'URI' => $stationURI
        ]));
    
        if ($response->successful()) {
            return redirect()->route('chargingStations.index')
                ->with('success', 'Charging station deleted successfully.');
        } else {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete the charging station.']);
        }
    }

    

}
