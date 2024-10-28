@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add New Route</h1>
    
    <form action="{{ route('routes.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="distanceValue" class="block text-sm font-medium text-gray-700">Distance Value (km):</label>
            <input type="number" step="0.1" id="distanceValue" name="distanceValue" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" placeholder="Enter distance">
        </div>

        <div class="mb-4">
            <label for="durationValue" class="block text-sm font-medium text-gray-700">Duration (minutes):</label>
            <input type="number" id="durationValue" name="durationValue" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" placeholder="Enter duration">
        </div>

        <div class="mb-4">
            <label for="co2EmissionValue" class="block text-sm font-medium text-gray-700">CO2 Emission Value:</label>
            <input type="number" step="0.01" id="co2EmissionValue" name="co2EmissionValue" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" placeholder="Enter CO2 emission value">
        </div>

        <div class="mb-4">
            <label for="routeType" class="block text-sm font-medium text-gray-700">Route Type:</label>
            <select id="routeType" name="routeType" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500">
                <option value="HIGHWAY">Highway</option>
                <option value="URBAN">Urban</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
            Add Route
        </button>
    </form>
</div>
@endsection
