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
            'subClass' => 'nullable |string|in:Scooter,ElectricVehicle,CombustionVehicle,Bicycle', // Validate subclass
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
        $response = Http::post('http://localhost:9090/ontology/vehicle/creates', [
            'vehicleType' => $validatedData['vehicleType'],
            'subClass' => $validatedData['subClass'],
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



public function search(Request $request)
{
    // Get search query parameters from the request
    $searchQuery = $request->query('q');
    $minSpeed = $request->query('minSpeed');
    $maxSpeed = $request->query('maxSpeed');
    $isElectric = $request->query('isElectric');

    // Call the backend ontology service for vehicle search
    $response = Http::get('http://localhost:9090/ontology/vehicle/search', [
        'vehicleType' => $searchQuery,
        'minSpeed' => $minSpeed,
        'maxSpeed' => $maxSpeed,
        'isElectric' => $isElectric,
    ]);

    // If the API call is successful, retrieve and pass the vehicles to the view
    if ($response->successful()) {
        $vehicles = $response->json();
        return view('vehicle.index', ['vehicles' => $vehicles]);
    } else {
        return redirect()->back()->withErrors(['error' => 'Failed to search vehicles.']);
    }
}


public function show($id)
{
    // Call the ontology service to get the vehicle by ID
    $response = Http::get('http://localhost:9090/ontology/vehicle/' . $id);

    if ($response->successful()) {
        $vehicle = $response->json(); // Get the vehicle from the API
        return view('vehicle.show', compact('vehicle'));
    } else {
        return redirect()->back()->withErrors(['error' => 'Vehicle not found.']);
    }
}


        


}
