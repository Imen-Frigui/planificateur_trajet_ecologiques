@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Routes</h2>
    <p>This table displays a list of ecological routes, detailing key information such as CO2 emissions, distance, and travel duration to help assess the environmental impact of each route.</p>
    <br>

    <!-- Toast Notification for Success -->
    @if (session('success'))
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg" role="alert">
            <!-- Toast notification code remains the same -->
        </div>
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

    <!-- Search Input for Filtering -->
    <div class="mb-4">
        <input type="text" id="routeSearch" placeholder="Search by CO2, distance, or duration..." class="w-full p-2 border border-gray-300 rounded-lg" onkeyup="filterRoutes()">
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
            <tbody id="routesTableBody" class="text-gray-700">
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

<script>
    function filterRoutes() {
        // Get the input value
        const searchInput = document.getElementById('routeSearch').value.toLowerCase();
        const rows = document.querySelectorAll('#routesTableBody tr');

        // Loop through each row and filter based on input
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const [routeId, co2Emission, distanceValue, durationValue] = cells;

            // Check if any of the cells contain the search term
            if (
                routeId.textContent.toLowerCase().includes(searchInput) ||
                co2Emission.textContent.toLowerCase().includes(searchInput) ||
                distanceValue.textContent.toLowerCase().includes(searchInput) ||
                durationValue.textContent.toLowerCase().includes(searchInput)
            ) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    }
</script>
@endsection
