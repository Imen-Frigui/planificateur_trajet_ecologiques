{{-- @extends('layouts.app')

@section('title', 'Create Weather Condition')

@section('content')
    <h1>Create Weather Condition</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('weather.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="weatherType">Weather Type</label>
            <input type="text" name="weatherType" id="weatherType" class="form-control" value="{{ old('weatherType') }}" required>
        </div>

        <div class="form-group">
            <label for="sunny">Sunny</label>
            <select name="sunny" id="sunny" class="form-control" required>
                <option value="1" {{ old('sunny') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('sunny') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="snowy">Snowy</label>
            <select name="snowy" id="snowy" class="form-control" required>
                <option value="1" {{ old('snowy') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('snowy') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="rainy">Rainy</label>
            <select name="rainy" id="rainy" class="form-control" required>
                <option value="1" {{ old('rainy') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('rainy') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="temperature">Temperature</label>
            <input type="number" name="temperature" id="temperature" class="form-control" step="0.1" value="{{ old('temperature') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Weather Condition</button>
    </form>
@endsection --}}
@extends('layouts.app')

@section('title', 'Create Weather Condition')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Weather Condition</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Something went wrong:</span>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('weather.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="weatherType" class="block text-sm font-medium text-gray-700">Weather Type:</label>
                <input type="text" name="weatherType" id="weatherType" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500" value="{{ old('weatherType') }}" required>
            </div>

            <div class="mb-4">
                <label for="sunny" class="block text-sm font-medium text-gray-700">Sunny:</label>
                <select name="sunny" id="sunny" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500" required>
                    <option value="1" {{ old('sunny') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('sunny') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="snowy" class="block text-sm font-medium text-gray-700">Snowy:</label>
                <select name="snowy" id="snowy" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500" required>
                    <option value="1" {{ old('snowy') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('snowy') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="rainy" class="block text-sm font-medium text-gray-700">Rainy:</label>
                <select name="rainy" id="rainy" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500" required>
                    <option value="1" {{ old('rainy') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('rainy') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="temperature" class="block text-sm font-medium text-gray-700">Temperature (°C):</label>
                <input type="number" name="temperature" id="temperature" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500" value="{{ old('temperature') }}" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                Create Weather Condition
            </button>
        </form>
    </div>
@endsection
