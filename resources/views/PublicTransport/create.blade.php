@extends('layouts.app')


@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">

<h1 class="text-2xl font-bold text-gray-800 mb-4">Add Public Transport</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    

    <form action="{{ route('public-transport.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="lineNumber" class="block text-sm font-medium text-gray-700">Line Number:</label>
        <input class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" type="text" id="lineNumber" name="lineNumber" value="{{ old('lineNumber') }}" required>
    </div>
    
    <div class="mb-4">
    <label for="shortDistance" class="block text-sm font-medium text-gray-700 mb-2">Short Distance:</label>
    <div class="flex items-center space-x-4">
        <div class="flex items-center">
            <input type="radio" id="shortDistanceYes" name="shortDistance" value="1" {{ old('shortDistance') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
            <label for="shortDistanceYes" class="ml-2 block text-sm text-gray-700">Yes</label>
        </div>
        <div class="flex items-center">
            <input type="radio" id="shortDistanceNo" name="shortDistance" value="0" {{ old('shortDistance') == '0' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
            <label for="shortDistanceNo" class="ml-2 block text-sm text-gray-700">No</label>
        </div>
    </div>
</div>

<div class="mb-4">
    <label for="operatesOnWeekend" class="block text-sm font-medium text-gray-700 mb-2">Operates on Weekend:</label>
    <div class="flex items-center space-x-4">
        <div class="flex items-center">
            <input type="radio" id="operatesOnWeekendYes" name="operatesOnWeekend" value="1" {{ old('operatesOnWeekend') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
            <label for="operatesOnWeekendYes" class="ml-2 block text-sm text-gray-700">Yes</label>
        </div>
        <div class="flex items-center">
            <input type="radio" id="operatesOnWeekendNo" name="operatesOnWeekend" value="0" {{ old('operatesOnWeekend') == '0' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
            <label for="operatesOnWeekendNo" class="ml-2 block text-sm text-gray-700">No</label>
        </div>
    </div>
</div>

    <div class="mb-4">
        <label for="transportType" class="block text-sm font-medium text-gray-700">Transport Type:</label>
        <select id="transportType" name="transportType" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" required>
            <option value="BUS" {{ old('transportType') == 'BUS' ? 'selected' : '' }}>BUS</option>
            <option value="SUBWAY" {{ old('transportType') == 'SUBWAY' ? 'selected' : '' }}>SUBWAY</option>
            <option value="TRAIN" {{ old('transportType') == 'TRAIN' ? 'selected' : '' }}>TRAIN</option>
        </select>
    </div>

<div class="mb-4">
    <label for="departureTime" class="block text-sm font-medium text-gray-700">Departure Time:</label>
    <input class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" type="datetime-local" id="departureTime" name="departureTime" value="{{ old('departureTime') }}" required>
</div>
<div class="mb-4">
    <label for="arrivalTime" class="block text-sm font-medium text-gray-700">Arrival Time:</label>
    <input class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" type="datetime-local" id="arrivalTime" name="arrivalTime" value="{{ old('arrivalTime') }}" required>
</div>
    
   
    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
    Add Transportt
            </button>
</form>

@endsection
