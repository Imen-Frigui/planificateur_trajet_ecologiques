<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicTransportController extends Controller
{
    private $apiUrl = 'http://localhost:9090/public-transport'; // URL of your Spring Boot API

    public function index()
    {
        $response = Http::get($this->apiUrl);
    
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data'], $response->status());
        }
    
        // Log the response to see its structure
        \Log::info($response->json());
    
        $publicTransportLines = $response->json(); // Assuming this returns an array of transport lines
    
        return view('PublicTransport.index', compact('publicTransportLines'));
    }
    


    public function show($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");

        if ($response->failed()) {
            return response()->json(['error' => 'Public transport not found'], $response->status());
        }

        return response()->json($response->json());
    }


    public function create()
    {
        return view('PublicTransport.create'); // Make sure this view exists
    }

//    $response = Http::get('http://localhost:9090/public-transport/add');

public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'lineNumber' => 'required|string|max:255',
        'shortDistance' => 'required|in:1,0', // Allow '1' or '0' for boolean
        'operatesOnWeekend' => 'required|in:1,0', // Allow '1' or '0' for boolean
        'transportType' => 'required|string|in:BUS,SUBWAY,TRAIN', // Validate transport type
        'arrivalTime' => 'required|date_format:Y-m-d\TH:i', // Validate datetime-local format
        'departureTime' => 'required|date_format:Y-m-d\TH:i', // Validate datetime-local format
    ]);

    // Convert '1'/'0' strings to boolean values
    $validatedData['shortDistance'] = $validatedData['shortDistance'] === '1';
    $validatedData['operatesOnWeekend'] = $validatedData['operatesOnWeekend'] === '1';

    // Prepare the data for the API
    $apiData = [
        'lineNumber' => $validatedData['lineNumber'],
        'shortDistance' => $validatedData['shortDistance'],
        'operatesOnWeekend' => $validatedData['operatesOnWeekend'],
        'arrivalTime' => $this->formatDateTime($validatedData['arrivalTime']),
        'departureTime' => $this->formatDateTime($validatedData['departureTime']),
        'transportType' => $validatedData['transportType'],
    ];

    // Log the data being sent to the API
    \Log::info('Data being sent to API:', $apiData);

    // Call the API to store the public transport line
    $response = Http::post('http://localhost:9090/public-transport/add', $apiData);

    // Check if the API call was successful
    if ($response->successful()) {
        return redirect()->route('public-transport.index')->with('success', 'Public transport line added successfully!');
    } else {
        // Log error response details
        \Log::error('API response error:', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json(),
        ]);
        
        return redirect()->back()->withErrors(['error' => 'Failed to add public transport.']);
    }
}

// Helper method to format datetime to Y-m-d\TH:i:s
private function formatDateTime($dateTime)
{
    return \Carbon\Carbon::parse($dateTime)->format('Y-m-d\TH:i:s');
}





    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'lineNumber' => 'sometimes|required|string',
            'shortDistance' => 'sometimes|required|boolean',
            'operatesOnWeekend' => 'sometimes|required|boolean',
            'transportType' => 'sometimes|required|string',
            'arrivalTime' => 'sometimes|required|string',
            'departureTime' => 'sometimes|required|string',
        ]);


        // Assuming your Spring Boot API has an endpoint for updating
        $response = Http::post("{$this->apiUrl}/update/{$id}", $data); // Change this according to your API

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to update public transport'], $response->status());
        }

        return response()->json($response->json(), $response->status());
    }








    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to delete public transport'], $response->status());
        }

        return response()->json(['message' => 'Public transport deleted successfully'], $response->status());
    }
}
