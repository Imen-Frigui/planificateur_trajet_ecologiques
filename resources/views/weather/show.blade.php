@extends('layouts.app')

@section('title', 'Weather Details')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Weather Details</h1>

        <p><strong>Type:</strong> {{ $weather['results']['bindings'][0]['weatherType']['value'] }}</p>
        <p><strong>Sunny:</strong> {{ $weather['results']['bindings'][0]['sunny']['value'] }}</p>
        <p><strong>Snowy:</strong> {{ $weather['results']['bindings'][0]['snowy']['value'] }}</p>
        <p><strong>Rainy:</strong> {{ $weather['results']['bindings'][0]['rainy']['value'] }}</p>
        <p><strong>Temperature:</strong> {{ $weather['results']['bindings'][0]['temperature']['value'] }} °C</p>

        <a href="{{ route('weather.index') }}" class="bg-blue-500 text-white px-4 py-2 mt-10 rounded-lg shadow hover:bg-blue-600 transition duration-200">
            Back to Weather Conditions
        </a>
    </div>
@endsection
