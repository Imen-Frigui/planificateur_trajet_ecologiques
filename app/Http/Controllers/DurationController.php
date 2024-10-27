<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DurationController extends Controller
{
    private $apiUrl = 'http://localhost:9090/duration'; // URL of your Spring Boot API

    public function index()
    {
        $response = Http::get($this->apiUrl);
    
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch durations'], $response->status());
        }
    
        // Log the response to see its structure
        \Log::info($response->json());
    
        $durations = $response->json(); // Assuming this returns an array of durations
    
        return view('Duration.index', compact('durations'));
    }

    public function show($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");

        if ($response->failed()) {
            return response()->json(['error' => 'Duration not found'], $response->status());
        }

        return response()->json($response->json());
    }

    public function create()
    {
        return view('Duration.create'); // Make sure this view exists
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'exactDuration' => 'required|integer|min:1', // Validates that the duration is a positive integer
            'longDuration' => 'required|in:1,0',
            'mediumDuration' => 'required|in:1,0',
            'shortDuration' => 'required|in:1,0',
        ]);


         // Convert '1'/'0' strings to boolean values
    $validatedData['longDuration'] = $validatedData['longDuration'] === '1';
    $validatedData['mediumDuration'] = $validatedData['mediumDuration'] === '1';
    $validatedData['shortDuration'] = $validatedData['shortDuration'] === '1';

        // Prepare the data for the API
        $apiData = [
            'exactDuration' => $validatedData['exactDuration'],
            'longDuration' => $validatedData['longDuration'],
            'mediumDuration' => $validatedData['mediumDuration'],
            'shortDuration' => $validatedData['shortDuration'],
        ];

        // Log the data being sent to the API
        \Log::info('Data being sent to API:', $apiData);

        // Call the API to store the duration
        $response = Http::post($this->apiUrl, $apiData); // Send data to the specified API

        // Check if the API call was successful
        if ($response->successful()) {
            return redirect()->route('duration.index')->with('success', 'Duration added successfully!');
        } else {
            // Log error response details
            \Log::error('API response error:', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to add duration.']);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'exactDuration' => 'sometimes|required|integer',
            'longDuration' => 'sometimes|required|boolean',
            'mediumDuration' => 'sometimes|required|boolean',
            'shortDuration' => 'sometimes|required|boolean',
        ]);

        // Assuming your Spring Boot API has an endpoint for updating
        $response = Http::post("{$this->apiUrl}/update/{$id}", $data); // Change this according to your API

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to update duration'], $response->status());
        }

        return response()->json($response->json(), $response->status());
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to delete duration'], $response->status());
        }

        return response()->json(['message' => 'Duration deleted successfully'], $response->status());
    }
}
