@extends('layouts.app')

@section('title', 'Create Vehicle')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Create Vehicle</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vehicle.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="vehicleType" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                <input type="text" name="vehicleType" id="vehicleType" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" value="{{ old('vehicleType') }}" required>
            </div>

            <div class="mb-4">
                <label for="subClass" class="block text-sm font-medium text-gray-700">Subclass:</label>
                <select id="subClass" name="subClass" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500">
                    <option value="Scooter">Scooter</option>
                    <option value="ElectricVehicle">Electric Vehicle</option>
                    <option value="CombustionVehicle">Combustion Vehicle</option>
                    <option value="Bicycle">Bicycle</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="isElectric" class="block text-sm font-medium text-gray-700">Electric</label>
                <select name="isElectric" id="isElectric" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" required>
                    <option value="1" {{ old('isElectric') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('isElectric') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="maxSpeed" class="block text-sm font-medium text-gray-700">Max Speed (km/h)</label>
                <input type="number" name="maxSpeed" id="maxSpeed" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" step="0.1" value="{{ old('maxSpeed') }}" required>
            </div>

            <div class="mb-4">
                <label for="energyConsumption" class="block text-sm font-medium text-gray-700">Energy Consumption (kWh)</label>
                <input type="number" name="energyConsumption" id="energyConsumption" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" step="0.1" value="{{ old('energyConsumption') }}" required>
            </div>

            <div class="mb-4">
                <label for="co2EmissionRate" class="block text-sm font-medium text-gray-700">CO2 Emission Rate (g/km)</label>
                <input type="number" name="co2EmissionRate" id="co2EmissionRate" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" step="0.1" value="{{ old('co2EmissionRate') }}" required>
            </div>

            <div class="mb-4">
                <label for="publicTransport" class="block text-sm font-medium text-gray-700">Public Transport</label>
                <select name="publicTransport" id="publicTransport" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" required>
                    <option value="1" {{ old('publicTransport') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('publicTransport') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add Vehicle
            </button>
        </form>
    </div>
@endsection
