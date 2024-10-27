@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Charging Stations</h2>

        @if(isset($error))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ $error }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('chargingStations.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add New Charging Station
            </a>
        </div>
        <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="{{ route('chargingStations.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="stationType" class="block text-sm font-medium text-gray-700 mb-1">Station Type</label>
                <select name="stationType" id="stationType" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                    <option value="">All Types</option>
                    <option value="public" {{ request('stationType') == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="private" {{ request('stationType') == 'private' ? 'selected' : '' }}>Private</option>
                </select>
            </div>

            <div>
                <label for="minSpeed" class="block text-sm font-medium text-gray-700 mb-1">Min Speed (kW)</label>
                <input type="number" name="minSpeed" id="minSpeed" value="{{ request('minSpeed') }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label for="maxSpeed" class="block text-sm font-medium text-gray-700 mb-1">Max Speed (kW)</label>
                <input type="number" name="maxSpeed" id="maxSpeed" value="{{ request('maxSpeed') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
            </div>

            <div>
                <label for="fastCharging" class="block text-sm font-medium text-gray-700 mb-1">Fast Charging</label>
                <select name="fastCharging" id="fastCharging" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                    <option value="">All</option>
                    <option value="true" {{ request('fastCharging') == 'true' ? 'selected' : '' }}>Yes</option>
                    <option value="false" {{ request('fastCharging') == 'false' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="md:col-span-4 flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                    Search
                </button>
                <a href="{{ route('chargingStations.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">Station Type</th>
                        <th class="py-2 px-4 text-left">Station URI</th>
                        <th class="py-2 px-4 text-left">Charging Speed (kW)</th>
                        <th class="py-2 px-4 text-left">Fast Charging</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($chargingStations as $station)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="py-2 px-4 border-b">{{ $station['stationType']['value'] ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ $station['station']['value'] }}" class="text-blue-600 hover:underline">
                                    {{ $station['station']['value'] }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $station['chargingSpeed']['value'] ?? 'N/A' }} kW</td>
                            <td class="py-2 px-4 border-b">{{ $station['fastCharging']['value'] === 'true' ? 'Yes' : 'No' }}</td>
                            <td class="py-2 px-4 border-b">
                            <div class="flex space-x-2">
                            <a href="{{ route('chargingStations.edit', ['uri' => urlencode($station['station']['value'])]) }}" 
                                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                                                        Edit
                                                    </a>
                                    <form action="{{ route('chargingStations.delete') }}?URI={{ urlencode($station['station']['value']) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this charging station?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No charging stations available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
