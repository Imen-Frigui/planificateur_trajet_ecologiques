@extends('layouts.app')

@section('title', 'Weather Conditions')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Weather Conditions</h1>
             <!-- Search Form -->
             <form action="{{ route('weather.search') }}" method="GET" class="mb-6">
                <div class="flex items-center space-x-4">
                    <input type="text" name="weatherType" placeholder="Search by weather type..." class="border rounded-lg p-2" value="{{ request()->query('weatherType') }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Search</button>
                </div>
            </form>
            <a href="{{ route('weather.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add Weather Condition
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

        @if(isset($weatherConditions['results']['bindings']) && count($weatherConditions['results']['bindings']) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Weather Type</th>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Sunny</th>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Snowy</th>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Rainy</th>
                            <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Temperature (°C)</th>
                            <th class="text-left py-3 px-4"></th>
                            <th class="text-left py-3 px-4"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($weatherConditions['results']['bindings'] as $condition)
                            <tr class="bg-gray-100">
                                <td class="text-left py-3 px-4">{{ $condition['weatherType']['value'] }}</td>
                                <td class="text-left py-3 px-4">{{ $condition['sunny']['value'] }}</td>
                                <td class="text-left py-3 px-4">{{ $condition['snowy']['value'] }}</td>
                                <td class="text-left py-3 px-4">{{ $condition['rainy']['value'] }}</td>
                                <td class="text-left py-3 px-4">{{ $condition['temperature']['value'] }}</td>
                                <td class="text-left py-3 px-4">
                                    @php
                                        $id = last(explode('#', $condition['weather']['value']));
                                    @endphp
                                    <a href="{{ route('weather.show', $id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">View</a>
                                </td>                                
                                <td class="text-left py-3 px-4">
                                    @php
                                        $id = last(explode('#', $condition['weather']['value']));
                                    @endphp
                                    <form action="{{ route('weather.destroy', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this weather condition?');">
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
            </div>
        @else
            <p class="text-gray-600">No weather conditions available.</p>
        @endif
    </div>
@endsection
