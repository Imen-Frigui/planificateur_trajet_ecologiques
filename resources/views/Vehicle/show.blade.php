@extends('layouts.app')

@section('title', 'View Vehicle')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Vehicle Details</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <strong class="font-bold">{{ $errors->first() }}</strong>
            </div>
        @endif

        <div class="mb-4">
            <strong>Vehicle Type:</strong> {{ $vehicle['results']['bindings'][0]['vehicleType']['value'] }}
        </div>
        <div class="mb-4">
            <strong>Electric:</strong> {{ $vehicle['results']['bindings'][0]['isElectric']['value'] === 'true' ? 'Yes' : 'No' }}
        </div>
        <div class="mb-4">
            <strong>Max Speed:</strong> {{ $vehicle['results']['bindings'][0]['maxSpeed']['value'] }} km/h
        </div>
        <div class="mb-4">
            <strong>Energy Consumption:</strong> {{ $vehicle['results']['bindings'][0]['energyConsumption']['value'] }} kWh
        </div>
        <div class="mb-4">
            <strong>CO2 Emission Rate:</strong> {{ $vehicle['results']['bindings'][0]['co2EmissionRate']['value'] }} g/km
        </div>
        <div class="mb-4">
            <strong>Public Transport:</strong> {{ $vehicle['results']['bindings'][0]['publicTransport']['value'] === 'true' ? 'Yes' : 'No' }}
        </div>

        <a href="{{ route('vehicle.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">Back to List</a>
    </div>
@endsection
