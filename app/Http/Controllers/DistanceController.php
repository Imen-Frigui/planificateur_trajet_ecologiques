<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class DistanceController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get the query parameters from the request
            $queryParams = array_filter([
                'minDistance' => $request->input('minDistance'),
                'maxDistance' => $request->input('maxDistance'),
            ]);
    
            // Send the GET request to the distance API
            $response = Http::get('http://localhost:9090/distance', $queryParams);
    
            // Check if the response is successful
            if ($response->successful()) {
                // Decode the JSON response to an associative array
                $distancesData = json_decode($response->body(), true);
                
                // Transform the distances data into a more usable format
                $distances = [];
                foreach ($distancesData as $item) {
                    $distances[] = [
                        'uri' => $item['distance']['value'], // The URI of the distance
                        'exactDistance' => $item['exactDistance']['value'], // The exact distance value
                        'longDistance' => filter_var($item['longDistance']['value'], FILTER_VALIDATE_BOOLEAN) // Convert string to boolean
                    ];
                }
    
                // Return the view with the processed distances
                return view('distances.index', ['distances' => $distances]);
            } else {
                Log::error('Error fetching distances', ['response' => $response->body()]);
                return view('distances.index', [
                    'error' => 'Failed to fetch distances.',
                    'distances' => []
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception in index method', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return view('distances.index', [
                'error' => 'An error occurred while fetching distances: ' . $e->getMessage(),
                'distances' => []
            ]);
        }
    }
    
    public function create()
    {
        return view('distances.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'exactDistance' => 'required|numeric|min:0', // Ensuring positive distance
            'longDistance' => 'required|boolean',
        ]);
        $randomId = (int) time(); // Ensure the ID is treated as an integer
        // Prepare the data for the distance API
        $distanceData = [
            'id' => $randomId, // Use the random ID
            'exactDistance' => $validatedData['exactDistance'],
            'longDistance' => false,
        ];
    
        // Send a request to the distance endpoint
        $response = Http::post('http://localhost:9090/distance', $distanceData);
    
        // Check if the request was successful
        if ($response->successful()) {
            return redirect()->route('distances.index')->with('success', 'Distance created successfully.');
        } else {
            Log::error('Failed to create distance', ['response' => $response->body()]);
            return redirect()->back()->withErrors(['error' => 'Failed to create distance.']);
        }
    }
    

    public function deleteDistance(Request $request)
{
    // Expecting the full URI to be passed in the request body
    $uri = $request->input('uri'); // Get the URI from the request

    // Extract the ID from the URI
    $id = null;

    if (preg_match('/Distance_(\d+)/', $uri, $matches)) {
        $id = $matches[1]; // Get the ID from the matches
    }

    if (is_null($id)) {
        return response()->json(['error' => 'Invalid URI. No ID found.'], 400);
    }

    // Sending DELETE request to the Spring Boot API
    $response = Http::delete("http://localhost:9090/distance/deleteById?id={$id}");  

    // Check the response status and return appropriate message
    if ($response->successful()) {
        return redirect()->route('distances.index')->with('success', 'Distance resource deleted successfully.');
    } else {
        return redirect()->route('distances.index')->withErrors(['error' => 'Failed to delete the distance resource.']);
    }
}

    public function edit($uri)
    {
        try {
            $decodedUri = urldecode($uri);
            $response = Http::get('http://localhost:9090/distance/uri', [
                'URI' => $decodedUri
            ]);

            if ($response->successful()) {
                $data = json_decode($response->body(), true);
                if (!empty($data) && is_array($data)) {
                    $distance = [
                        'stationURI' => $decodedUri,
                        'distanceValue' => $data[0]['distanceValue']['value']
                    ];
                    return view('distances.edit', compact('distance'));
                }
                return redirect()->route('distances.index')->with('error', 'No distance details found.');
            }
            Log::error('Failed to fetch distance details', ['response' => $response->body()]);
            return redirect()->route('distances.index')->with('error', 'Failed to fetch distance details.');
        } catch (\Exception $e) {
            Log::error('Exception in edit method', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('distances.index')->with('error', 'An error occurred while fetching the distance: ' . $e->getMessage());
        }
    }

    public function update($uri, Request $request)
    {
        try {
            $encodedUri = urlencode($uri);
            $response = Http::put("http://localhost:9090/distance/{$encodedUri}", [
                'distanceValue' => $request->distanceValue,
                'stationURI' => $request->stationURI
            ]);

            if ($response->successful()) {
                return redirect()->route('distances.index')->with('success', 'Distance updated successfully.');
            } else {
                Log::error('Failed to update distance', ['response' => $response->body()]);
                return back()->with('error', 'Failed to update distance.');
            }
        } catch (\Exception $e) {
            Log::error('Exception in update method', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
