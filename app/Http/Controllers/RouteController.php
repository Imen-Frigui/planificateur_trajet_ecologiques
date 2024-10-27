<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RouteController extends Controller
{
    public function index()
{
    // Fetch route data from the Spring API
    $response = Http::get('http://localhost:9090/route');

    if ($response->successful()) {
        // Directly get the JSON response as an array
        $routes = $response->json();

        // Pass the routes array directly to the view
        return view('routes.index', ['routes' => $routes]);
    } else {
        return view('routes.index', ['routes' => []]);
    }
}

    public function create()
    {
        return view('routes.create');
    }

    // Store a new route
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'name' => 'required|string|max:255',
            'co2EmissionValue' => 'required|numeric',
            'distanceValue' => 'required|numeric',
            'durationValue' => 'required|integer',
            // 'speed' => 'required|numeric'
        ]);

        $response = Http::post('http://localhost:9090/route', [
            'name' => $validatedData['name'],
            'co2EmissionValue' => $validatedData['co2EmissionValue'],
            'distanceValue' => $validatedData['distanceValue'],
            'durationValue' => $validatedData['durationValue'],
            'speed' => $validatedData['speed'],
        ]);

        if ($response->successful()) {
            return redirect()->route('routes.index')->with('success', 'Route created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to create route.']);
        }
    }
}