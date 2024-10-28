<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {

        $response = Http::get('http://localhost:9090/ontology/weathers');

        if ($response->successful()) {
            $weatherConditions = $response->json(); // Get the weather data from API
            return view('weather.index', ['weatherConditions' => $weatherConditions]);
        } else {
            return view('weather.index', ['weatherConditions' => []]);
        }
    }

    public function create()
    {
        return view('weather.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'weatherType' => 'required|string|max:255',
            'sunny' => 'required|in:1,0',
            'snowy' => 'required|in:1,0',
            'rainy' => 'required|in:1,0',
            'temperature' => 'required|numeric',
        ]);

        // Convert '1'/'0' strings to boolean values
        $validatedData['sunny'] = $validatedData['sunny'] === '1' ? true : false;
        $validatedData['snowy'] = $validatedData['snowy'] === '1' ? true : false;
        $validatedData['rainy'] = $validatedData['rainy'] === '1' ? true : false;

        // Call the API to store the weather condition
        $response = Http::post('http://localhost:9090/ontology/createWeathers', [
            'weatherType' => $validatedData['weatherType'],
            'sunny' => $validatedData['sunny'],
            'snowy' => $validatedData['snowy'],
            'rainy' => $validatedData['rainy'],
            'temperature' => $validatedData['temperature'],
        ]);

        if ($response->successful()) {
            return redirect()->route('weather.index')->with('success', 'Weather condition created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to create weather condition.']);
        }
    }

    public function destroy($id)
    {
        $response = Http::delete('http://localhost:9090/ontology/weather/' . $id);

        if ($response->successful()) {
            return redirect()->route('weather.index')->with('success', 'Weather condition deleted successfully.');
        } else {
            return redirect()->route('weather.index')->withErrors(['error' => 'Failed to delete weather condition.']);
        }
    }

    public function searchWeather(Request $request)
    {
        $searchQuery = $request->query('weatherType'); // Example of filtering by weather type

        // Build the query parameters for the API call
        $params = [
            'weatherType' => $searchQuery
        ];

        // Call the ontology weather search API
        $response = Http::get('http://localhost:9090/ontology/weather', $params);

        if ($response->successful()) {
            $weathers = $response->json(); // Get the weather conditions from the API
            return view('weather.index', ['weathers' => $weathers]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to retrieve weather data.']);
        }
    }

    public function show($id)
    {
        $response = Http::get("http://localhost:9090/ontology/weather/{$id}");
        $weather = $response->json();

        if (isset($weather['error'])) {
            return redirect()->route('weather.index')->withErrors(['error' => 'Weather condition not found.']);
        }

        return view('weather.show', compact('weather'));
    }




}
