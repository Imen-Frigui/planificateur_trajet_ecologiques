<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class SpeedController extends Controller
{
    private $apiBase = 'http://localhost:9090/speed';

    // Display all speeds
    public function index()
    {
        $response = Http::get($this->apiBase);
    
        if ($response->successful()) {
            // Convert fastSpeed, mediumSpeed, and slowSpeed to boolean values
            $speeds = array_map(function($speed) {
                $speed['fastSpeed'] = filter_var($speed['fastSpeed'], FILTER_VALIDATE_BOOLEAN);
                $speed['mediumSpeed'] = filter_var($speed['mediumSpeed'], FILTER_VALIDATE_BOOLEAN);
                $speed['slowSpeed'] = filter_var($speed['slowSpeed'], FILTER_VALIDATE_BOOLEAN);
                return $speed;
            }, $response->json());
    
            return view('speeds.index', ['speeds' => $speeds]);
        } else {
            return view('speeds.index', ['speeds' => []])->withErrors(['error' => 'Failed to fetch speeds.']);
        }
    }

    // Display form to create a new speed
    public function create()
    {
        return view('speeds.create');
    }

    // Store a new speed
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'speedValue' => 'required|numeric',
            'fastSpeed' => 'nullable|boolean',
            'mediumSpeed' => 'nullable|boolean',
            'slowSpeed' => 'nullable|boolean',
        ]);
    
        // Convert checkboxes to booleans if not provided
        $speedData = [
            'speedValue' => $validatedData['speedValue'],
            'fastSpeed' => $request->has('fastSpeed') ? (bool) $request->input('fastSpeed') : false,
            'mediumSpeed' => $request->has('mediumSpeed') ? (bool) $request->input('mediumSpeed') : false,
            'slowSpeed' => $request->has('slowSpeed') ? (bool) $request->input('slowSpeed') : false,
        ];
    
        $response = Http::post($this->apiBase, $speedData);
    
        return $response->successful()
            ? redirect()->route('speeds.index')->with('success', 'Speed added successfully.')
            : redirect()->back()->withErrors(['error' => 'Failed to add speed.']);
    }

    
    // Display a specific speed by ID
    public function show($id)
    {
        $response = Http::get("http://localhost:9090/route/{$id}");
    
        if ($response->successful()) {
            $routeData = $response->json();
    
            // Prepare speed-related data for the view
            $speedData = [
                'id' => $id,
                'averageSpeed' => $routeData['averageSpeed'] ?? 'N/A',
                'maxSpeed' => $routeData['maxSpeed'] ?? 'N/A',
                'minSpeed' => $routeData['minSpeed'] ?? 'N/A',
                'speedUnit' => $routeData['speedUnit'] ?? 'km/h', // Default to 'km/h' if unit is not provided
            ];
    
            return view('speeds.show', compact('speedData'));
        } else {
            return redirect()->route('speeds.index')->withErrors(['error' => 'Failed to fetch speed details.']);
        }
    }

    // Display form to edit an existing speed
    public function edit($id)
    {
        $response = Http::get("{$this->apiBase}/{$id}");

        if ($response->successful()) {
            $speed = $response->json();
            return view('speeds.edit', ['speed' => $speed, 'id' => $id]);
        } else {
            return redirect()->route('speeds.index')->withErrors(['error' => 'Failed to fetch speed details.']);
        }
    }

    // Update an existing speed
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'speedValue' => 'required|numeric',
            'fastSpeed' => 'required|boolean',
            'mediumSpeed' => 'required|boolean',
            'slowSpeed' => 'required|boolean',
        ]);

        $response = Http::put("{$this->apiBase}/{$id}", [
            'speedValue' => $validatedData['speedValue'],
            'fastSpeed' => $validatedData['fastSpeed'],
            'mediumSpeed' => $validatedData['mediumSpeed'],
            'slowSpeed' => $validatedData['slowSpeed'],
        ]);

        return $response->successful()
            ? redirect()->route('speeds.index')->with('success', 'Speed updated successfully.')
            : redirect()->back()->withErrors(['error' => 'Failed to update speed.']);
    }

    // Delete a speed by ID
    public function destroy($id)
    {
        // Use the extracted ID in the delete URL
        $response = Http::delete("{$this->apiBase}/{$id}");
    
        return $response->successful()
            ? redirect()->route('speeds.index')->with('success', 'Speed deleted successfully.')
            : redirect()->route('speeds.index')->withErrors(['error' => 'Failed to delete speed.']);
    }

    
}
