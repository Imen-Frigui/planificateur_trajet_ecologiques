@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Route Details</h1>
    
    <p><strong>Route ID:</strong> {{ $route['id'] }}</p>
    <p><strong>CO2 Emission Value:</strong> {{ $route['co2EmissionValue'] }}</p>
    <p><strong>Distance Value:</strong> {{ $route['distanceValue'] }} km</p>
    <p><strong>Duration:</strong> {{ $route['durationValue'] }} min</p>

    <div class="mt-4">
        <a href="{{ route('routes.index') }}" class="text-blue-500 hover:underline">Back to Routes</a>
    </div>
</div>
@endsection
