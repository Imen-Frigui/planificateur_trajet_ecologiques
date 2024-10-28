@extends('layouts.app')

@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Add Duration</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('duration.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="exactDuration" class="block text-sm font-medium text-gray-700">Exact Duration (in minutes):</label>
                <input class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" type="number" id="exactDuration" name="exactDuration" value="{{ old('exactDuration') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Long Duration:</label>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input type="radio" id="longDurationYes" name="longDuration" value="1" {{ old('longDuration') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <label for="longDurationYes" class="ml-2 block text-sm text-gray-700">Yes</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="longDurationNo" name="longDuration" value="0" {{ old('longDuration') == '0' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <label for="longDurationNo" class="ml-2 block text-sm text-gray-700">No</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Medium Duration:</label>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input type="radio" id="mediumDurationYes" name="mediumDuration" value="1" {{ old('mediumDuration') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <label for="mediumDurationYes" class="ml-2 block text-sm text-gray-700">Yes</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="mediumDurationNo" name="mediumDuration" value="0" {{ old('mediumDuration') == '0' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <label for="mediumDurationNo" class="ml-2 block text-sm text-gray-700">No</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Short Duration:</label>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input type="radio" id="shortDurationYes" name="shortDuration" value="1" {{ old('shortDuration') == '1' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <label for="shortDurationYes" class="ml-2 block text-sm text-gray-700">Yes</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="shortDurationNo" name="shortDuration" value="0" {{ old('shortDuration') == '0' ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <label for="shortDurationNo" class="ml-2 block text-sm text-gray-700">No</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add Duration
            </button>
        </form>
    </div>
</body>
@endsection
