@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Vehicles</h1>
            <!-- Add Create Button -->
            <a href="{{ route('vehicle.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add Vehicle
            </a>
        </div>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-2" role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <strong class="font-bold">{{ $errors->first() }}</strong>
            </div>
        @endif

        @if(count($vehicles['results']['bindings']) > 0)
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-600">Type</th>
                        <th class="px-4 py-2 text-left text-gray-600">Vehicle Subclass</th>
                        <th class="px-4 py-2 text-left text-gray-600">Electric</th>
                        <th class="px-4 py-2 text-left text-gray-600">Max Speed</th>
                        <th class="px-4 py-2 text-left text-gray-600">Energy Consumption</th>
                        <th class="px-4 py-2 text-left text-gray-600">CO2 Emission Rate</th>
                        <th class="px-4 py-2 text-left text-gray-600">Public Transport</th>
                        <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles['results']['bindings'] as $vehicle)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $vehicle['vehicleType']['value'] }}</td>
                            <td class="px-4 py-2">{{ $vehicle['subClass']['value'] ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $vehicle['isElectric']['value'] === 'true' ? 'Yes' : 'No' }}</td>
                            <td class="px-4 py-2">{{ $vehicle['maxSpeed']['value'] }} km/h</td>
                            <td class="px-4 py-2">{{ $vehicle['energyConsumption']['value'] }} kWh</td>
                            <td class="px-4 py-2">{{ $vehicle['co2EmissionRate']['value'] }} g/km</td>
                            <td class="px-4 py-2">{{ $vehicle['publicTransport']['value'] === 'true' ? 'Yes' : 'No' }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $id = last(explode('#', $vehicle['vehicle']['value']));
                                @endphp
                                <form action="{{ route('vehicle.destroy', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No vehicles available.</p>
        @endif
    </div>
@endsection
