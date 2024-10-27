@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Distances</h2>

        @if(isset($error))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ $error }}
            </div>
        @endif

        <div class="mb-4">
    <a href="{{ route('distances.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
        Add New Distance
    </a>
</div>


        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('distances.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="minDistance" class="block text-sm font-medium text-gray-700 mb-1">Min Distance (km)</label>
                    <input type="number" name="minDistance" id="minDistance" value="{{ request('minDistance') }}" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                </div>

                <div>
                    <label for="maxDistance" class="block text-sm font-medium text-gray-700 mb-1">Max Distance (km)</label>
                    <input type="number" name="maxDistance" id="maxDistance" value="{{ request('maxDistance') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                        Search
                    </button>
                    <a href="{{ route('distances.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition duration-200 ml-2">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">Distance URI</th>
                        <th class="py-2 px-4 text-left">Exact Distance (km)</th>
                        <th class="py-2 px-4 text-left">Long Distance</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($distances as $distance)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="py-2 px-4 border-b">
                                <a href="{{ $distance['uri'] }}" class="text-blue-600 hover:underline">
                                    {{ $distance['uri'] }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $distance['exactDistance'] ?? 'N/A' }} km</td>
                            <td class="py-2 px-4 border-b">{{ $distance['longDistance'] ? 'Yes' : 'No' }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-2">
                                    <a href="#" 
                                       class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                                       Edit
                                    </a>
                                                                            <!-- Delete button -->
                                                                            <form action="{{ route('distances.delete') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="uri" value="{{ $distance['uri']}}">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">
                                    Delete Distance
                                </button>
                            </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No distances available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
