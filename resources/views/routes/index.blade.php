@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Routes</h2>
    <p>This table displays a list of ecological routes, detailing key information such as CO2 emissions, distance, and travel duration to help assess the environmental impact of each route.</p>
    <br>

    <!-- Toast Notification for Success -->
    @if (session('success'))
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z"/>
                </svg>
                <span class="sr-only">Success icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
            <button type="button" class="ml-auto bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100" onclick="hideToast('toast-success')">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <script>
            // Function to hide the toast notification
            function hideToast(id) {
                document.getElementById(id).style.display = 'none';
            }

            // Auto-hide the toast after 3 seconds
            setTimeout(() => hideToast('toast-success'), 3000);
        </script>
    @endif

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('routes.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
            <i class="fas fa-plus"></i> Add New Route
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-2 px-4 text-left">Route ID</th>
                    <th class="py-2 px-4 text-left">CO2 Emission Value</th>
                    <th class="py-2 px-4 text-left">Distance Value (km)</th>
                    <th class="py-2 px-4 text-left">Duration (min)</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($routes as $route)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4 border-b">{{ Str::after($route['route']['value'], '#') }}</td>
                        <td class="py-2 px-4 border-b">{{ $route['co2EmissionValue']['value'] ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $route['distanceValue']['value'] ?? 'N/A' }} km</td>
                        <td class="py-2 px-4 border-b">{{ $route['durationValue']['value'] ?? 'N/A' }} min</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            <a href="{{ route('routes.show', Str::after($route['route']['value'], '#')) }}" class="text-blue-500 hover:underline"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('routes.edit', Str::after($route['route']['value'], '#')) }}" class="text-yellow-500 hover:underline"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('routes.destroy', Str::after($route['route']['value'], '#')) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No routes available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
    </div>
</div>
@endsection
