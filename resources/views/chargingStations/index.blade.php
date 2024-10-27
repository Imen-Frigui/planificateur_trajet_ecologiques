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
                            <form action="{{ route('chargingStations.delete') }}?URI={{ urlencode($station['station']['value']) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete this charging station?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">Delete</button>
                                </form>
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
