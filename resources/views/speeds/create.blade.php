@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add New Speed</h1>

    <form action="{{ route('speeds.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="speedValue" class="block text-sm font-medium text-gray-700">Speed Value:</label>
            <input type="number" id="speedValue" name="speedValue" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Enter speed value">
        </div>

        <div class="mb-4">
            <label for="fastSpeed" class="block text-sm font-medium text-gray-700">Fast Speed:</label>
            <input type="hidden" name="fastSpeed" value="0">
            <input type="checkbox" id="fastSpeed" name="fastSpeed" value="1" class="mt-1 block">
        </div>

        <div class="mb-4">
            <label for="mediumSpeed" class="block text-sm font-medium text-gray-700">Medium Speed:</label>
            <input type="hidden" name="mediumSpeed" value="0">
            <input type="checkbox" id="mediumSpeed" name="mediumSpeed" value="1" class="mt-1 block">
        </div>

        <div class="mb-4">
            <label for="slowSpeed" class="block text-sm font-medium text-gray-700">Slow Speed:</label>
            <input type="hidden" name="slowSpeed" value="0">
            <input type="checkbox" id="slowSpeed" name="slowSpeed" value="1" class="mt-1 block">
        </div>

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
            Add Speed
        </button>
    </form>
</div>
@endsection
