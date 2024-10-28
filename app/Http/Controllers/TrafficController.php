<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrafficController extends Controller
{
    public function index(Request $request)
    {
        try {
            $response = Http::get('http://localhost:9090/trafficCondition');

            if ($response->successful()) {
                $trafficConditions = json_decode($response->body(), true);
                return view('trafficConditions.index', ['trafficConditions' => $trafficConditions]);
            } else {
                return view('trafficConditions.index', [
                    'error' => 'Failed to fetch traffic conditions.',
                    'trafficConditions' => []
                ]);
            }
        } catch (\Exception $e) {
            return view('trafficConditions.index', [
                'error' => 'An error occurred while fetching traffic conditions: ' . $e->getMessage(),
                'trafficConditions' => []
            ]);
        }
    }

    public function create()
    {
        return view('trafficConditions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trafficLevel' => 'required|string|max:255',
            'averageDelay' => 'required|integer',
        ]);

        $response = Http::post('http://localhost:9090/trafficCondition', [
            'id' => (int)time(),
            'trafficLevel' => $validatedData['trafficLevel'],
            'averageDelay' => $validatedData['averageDelay'],
        ]);

        if ($response->successful()) {
            return redirect()->route('trafficConditions.index')->with('success', 'Traffic condition created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to create traffic condition.']);
        }
    }

    public function edit($id)
{
    try {
        // Extract the ID from the provided URI
        // Assuming $id is the full URI
        $idParts = explode('#', $id); // Split the URI
        $trafficConditionId = end($idParts); // Get the last part (the ID)

        $response = Http::get("http://localhost:9090/trafficCondition/{$trafficConditionId}");

        if ($response->successful()) {
            $trafficCondition = json_decode($response->body(), true);
            return view('trafficConditions.edit', compact('trafficCondition'));
        }

        return redirect()->route('trafficConditions.index')
            ->with('error', 'Failed to fetch traffic condition details.');
    } catch (\Exception $e) {
        Log::error('Exception in edit method', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->route('trafficConditions.index')
            ->with('error', 'An error occurred while fetching the traffic condition: ' . $e->getMessage());
    }
}


    public function update($id, Request $request)
    {
        try {
            $response = Http::put("http://localhost:9090/trafficCondition/{$id}", [
                'trafficLevel' => $request->trafficLevel,
                'averageDelay' => $request->averageDelay,
            ]);

            if ($response->successful()) {
                return redirect()->route('trafficConditions.index')
                    ->with('success', 'Traffic condition updated successfully.');
            } else {
                return back()->with('error', 'Failed to update traffic condition.');
            }
        } catch (\Exception $e) {
            Log::error('Exception in update method', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function deleteTrafficCondition(Request $request)
    {
        // Expecting the full URI to be passed in the request body
        $uri = $request->input('uri'); // Get the URI from the request
    
        // Extract the ID from the URI
        $id = null;
    
        // Assuming your traffic condition URIs follow a similar pattern to the distance URIs
        if (preg_match('/TrafficCondition_(\d+)/', $uri, $matches)) {
            $id = $matches[1]; // Get the ID from the matches
        }
    
        if (is_null($id)) {
            return response()->json(['error' => 'Invalid URI. No ID found.'], 400);
        }
    
        // Sending DELETE request to the Spring Boot API
        $response = Http::delete("http://localhost:9090/trafficCondition/{$id}");
    
        // Check the response status and return appropriate message
        if ($response->successful()) {
            return redirect()->route('trafficConditions.index')->with('success', 'Traffic condition resource deleted successfully.');
        } else {
            return redirect()->route('trafficConditions.index')->withErrors(['error' => 'Failed to delete the traffic condition resource.']);
        }
    }
    
    
}
