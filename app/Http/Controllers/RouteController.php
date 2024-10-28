<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class RouteController extends Controller
{
    // Display all routes
    public function index()
    {
        // Fetch route data from the Spring API
        $response = Http::get('http://localhost:9090/route');

        if ($response->successful()) {
            $routes = $response->json();
            return view('routes.index', ['routes' => $routes]);
        } else {
            return view('routes.index', ['routes' => []]);
        }
    }

    // Display form to create a new route
    public function create()
    {
        return view('routes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'co2EmissionValue' => 'required|numeric',
            'distanceValue' => 'required|numeric',
            'durationValue' => 'required|integer',
            'routeType' => 'required|string',
        ]);

        $response = Http::post('http://localhost:9090/route', [
            'co2EmissionValue' => $validatedData['co2EmissionValue'],
            'distanceValue' => $validatedData['distanceValue'],
            'durationValue' => $validatedData['durationValue'],
            'routeType' => $validatedData['routeType'],
        ]);

        if ($response->successful()) {
            // Redirect to the index route with a success message
            return redirect()->route('routes.index')->with('success', 'Route created successfully.');
        } else {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'Failed to create route.']);
        }
    }

    // Display a specific route by ID
    public function show($id)
    {
        $response = Http::get("http://localhost:9090/route/{$id}");
    
        if ($response->successful()) {
            $routeData = $response->json();
    
            // Extracting actual values from nested data
            $route = [
                'id' => $id,
                'distanceValue' => $routeData['distanceValue']['value'] ?? '10.0',
                'durationValue' => $routeData['durationValue']['value'] ?? '20',
                'co2EmissionValue' => $routeData['co2EmissionValue']['value'] ?? '0.4',
            ];
    
            return view('routes.show', compact('route'));
        } else {
            return redirect()->route('routes.index')->withErrors(['error' => 'Failed to fetch route details.']);
        }
    }
    
   // Display form to edit an existing route
public function edit($id)
{
    $response = Http::get("http://localhost:9090/route/{$id}");

    if ($response->successful()) {
        $routeData = $response->json();

        // Make sure the data is properly extracted
        $route = [
            'id' => Str::after($id, '#'),
            'distanceValue' => $routeData['distanceValue']['value'] ?? null,
            'durationValue' => $routeData['durationValue']['value'] ?? null,
            'co2EmissionValue' => $routeData['co2EmissionValue']['value'] ?? null,
        ];

        return view('routes.edit', compact('route'));
    } else {
        return redirect()->route('routes.index')->withErrors(['error' => 'Failed to fetch route details.']);
    }
}

    // Update an existing route
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'co2EmissionValue' => 'required|numeric',
            'distanceValue' => 'required|numeric',
            'durationValue' => 'required|integer',
        ]);

        $response = Http::put("http://localhost:9090/route/{$id}", [
            'co2EmissionValue' => $validatedData['co2EmissionValue'],
            'distanceValue' => $validatedData['distanceValue'],
            'durationValue' => $validatedData['durationValue'],
        ]);

        if ($response->successful()) {
            return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to update route.']);
        }
    }

    // Delete a route by ID
    public function destroy($id)
    {
        $response = Http::delete("http://localhost:9090/route/{$id}");

        if ($response->successful()) {
            return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
        } else {
            return redirect()->route('routes.index')->withErrors(['error' => 'Failed to delete route.']);
        }
    }
}
