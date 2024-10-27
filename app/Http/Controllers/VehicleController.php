<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VehicleController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:9090/ontology/vehicle/all');

        if ($response->successful()) {
            $vehicles = $response->json(); // Get the vehicle data from API
            return view('vehicle.index', ['vehicles' => $vehicles]);
        } else {
            return view('vehicle.index', ['vehicles' => []]);
        }
    }

    public function create()
    {
        return view('vehicle.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'vehicleType' => 'required|string|max:255',
            'isElectric' => 'required|in:1,0',
            'maxSpeed' => 'required|numeric',
            'energyConsumption' => 'required|numeric',
            'co2EmissionRate' => 'required|numeric',
            'publicTransport' => 'required|in:1,0',
        ]);

        // Convert '1'/'0' strings to boolean values
        $validatedData['isElectric'] = $validatedData['isElectric'] === '1' ? true : false;
        $validatedData['publicTransport'] = $validatedData['publicTransport'] === '1' ? true : false;

        // Call the API to store the vehicle
        $response = Http::post('http://localhost:9090/ontology/vehicle/create', [
            'vehicleType' => $validatedData['vehicleType'],
            'isElectric' => $validatedData['isElectric'],
            'maxSpeed' => $validatedData['maxSpeed'],
            'energyConsumption' => $validatedData['energyConsumption'],
            'co2EmissionRate' => $validatedData['co2EmissionRate'],
            'publicTransport' => $validatedData['publicTransport'],
        ]);

        if ($response->successful()) {
            return redirect()->route('vehicle.index')->with('success', 'Vehicle created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to create vehicle.']);
        }
    }
        public function destroy($id)
    {
        $response = Http::delete('http://localhost:9090/ontology/vehicle/delete/' . $id);

        if ($response->successful()) {
            return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
        } else {
            return redirect()->route('vehicle.index')->withErrors(['error' => 'Failed to delete vehicle.']);
        }
    }


}
