@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Traffic Conditions</h2>

        @if(isset($error))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ $error }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('trafficConditions.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add New Traffic Condition
            </a>
        </div>

        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('trafficConditions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="trafficLevel" class="block text-sm font-medium text-gray-700 mb-1">Traffic Level</label>
                    <input type="text" name="trafficLevel" id="trafficLevel" value="{{ request('trafficLevel') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                </div>

                <div>
                    <label for="averageDelay" class="block text-sm font-medium text-gray-700 mb-1">Average Delay (minutes)</label>
                    <input type="number" name="averageDelay" id="averageDelay" value="{{ request('averageDelay') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                </div>

                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                        Search
                    </button>
                    <a href="{{ route('trafficConditions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition duration-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">Traffic Level</th>
                        <th class="py-2 px-4 text-left">Traffic Condition ID</th>
                        <th class="py-2 px-4 text-left">Average Delay (minutes)</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($trafficConditions as $condition)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="py-2 px-4 border-b">{{ $condition['trafficLevel']['value'] ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ $condition['trafficCondition']['value'] }}" class="text-blue-600 hover:underline">
                                    {{ $condition['trafficCondition']['value'] }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $condition['averageDelay']['value'] ?? 'N/A' }} minutes</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-2">
                                <a href="{{ route('trafficConditions.edit', ['id' => urlencode($condition['trafficCondition']['value'])]) }}"
    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">
    Edit
</a>

<form action="{{ route('trafficConditions.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this traffic condition?');" class="inline">
    @csrf
    @method('DELETE') <!-- This is the correct way to indicate a DELETE request -->
    <input type="hidden" name="uri" value="{{ $condition['trafficCondition']['value'] }}">
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">
        Delete
    </button>
</form>




                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No traffic conditions available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
