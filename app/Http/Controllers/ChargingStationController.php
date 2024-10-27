<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class ChargingStationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $queryParams = array_filter([
                'stationType' => $request->input('stationType'),
                'minSpeed' => $request->input('minSpeed'),
                'maxSpeed' => $request->input('maxSpeed'),
                'fastCharging' => $request->input('fastCharging'),
            ]);

            $response = Http::get('http://localhost:9090/charging/search', $queryParams);

            if ($response->successful()) {
                $chargingStations = json_decode($response->body(), true);
                return view('chargingStations.index', ['chargingStations' => $chargingStations]);
            } else {
                return view('chargingStations.index', [
                    'error' => 'Failed to fetch charging stations.',
                    'chargingStations' => []
                ]);
            }
        } catch (\Exception $e) {
            return view('chargingStations.index', [
                'error' => 'An error occurred while fetching charging stations: ' . $e->getMessage(),
                'chargingStations' => []
            ]);
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
    public function edit($uri)
{
    try {
        // Decode the URI parameter if it's URL encoded
        $decodedUri = urldecode($uri);
        
        \Log::info('Decoded URI:', ['uri' => $decodedUri]);

        $response = Http::get('http://localhost:9090/charging/uri', [
            'URI' => $decodedUri
        ]);

        if ($response->successful()) {
            $data = json_decode($response->body(), true);
            
            if (!empty($data) && is_array($data) && count($data) > 0) {
                $station = [
                    'station' => [
                        'value' => $decodedUri 
                    ],
                    'stationType' => $data[0]['stationType']['value'],
                    'chargingSpeed' => $data[0]['chargingSpeed']['value'],
                    'fastCharging' => $data[0]['fastCharging']['value']
                ];
                
                return view('chargingStations.edit', compact('station'));
            }
            
            return redirect()->route('chargingStations.index')
                ->with('error', 'No charging station details found.');
        }
        
        return redirect()->route('chargingStations.index')
            ->with('error', 'Failed to fetch charging station details.');
            
    } catch (\Exception $e) {
        \Log::error('Exception in edit method', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->route('chargingStations.index')
            ->with('error', 'An error occurred while fetching the charging station: ' . $e->getMessage());
    }
}


    

    public function update($uri, Request $request)
{
    try {

        $encodedUri = urlencode(string: $uri);
        \Log::error('Exception in edit method', [
            'message' => $encodedUri,
            
        ]);
        $response = Http::put("http://localhost:9090/charging/{$encodedUri}", [
            'chargingSpeed' => $request->chargingSpeed,
            'fastCharging' => $request->fastCharging,
            'stationType' => $request->stationType
        ]);

        if ($response->successful()) {
            return redirect()->route('chargingStations.index')
                ->with('success', 'Charging station updated successfully.');
        } else {
            \Log::error('Exception in edit method', [
                'message' => $response,
                
            ]);
            return back()->with('error', 'Failed to update charging station.');
        }
    } catch (\Exception $e) {
        \Log::error('Exception in edit method', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

    

}
