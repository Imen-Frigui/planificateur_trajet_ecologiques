@extends('layouts.app')

@section('title', 'Public Transport')

@section('content')
<script src="{{ asset('resources/js/deleteTransport.js') }}"></script>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Public Transport</h2>

    <div class="mb-4">
        <a href="{{ route('public-transport.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">Add Transport</a>
    </div>

    @if(session('success'))
    <div
        id="success-alert"
        class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-700 text-green-900 dark:text-green-100 mb-5 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-green-200 dark:hover:bg-green-800 transform hover:scale-105"
    >
        <svg
            stroke="currentColor"
            viewBox="0 0 24 24"
            fill="none"
            class="h-5 w-5 flex-shrink-0 mr-2 text-green-600"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                stroke-width="2"
                stroke-linejoin="round"
                stroke-linecap="round"
            ></path>
        </svg>
        <p class="text-xs font-semibold">{{ session('success') }}</p>
    </div>

    <script>
        // Fade out the success alert after 3 seconds
        setTimeout(function() {
            const alertBox = document.getElementById('success-alert');
            alertBox.classList.add('opacity-0', 'transition-opacity', 'duration-1000'); // Add classes for fade out
            alertBox.classList.remove('mb-5'); // Optionally remove margin if you want a smoother transition
        }, 3000);
    </script>
@endif


@if(isset($error))
    <div
        id="error-alert"
        role="alert"
        class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-700 text-red-900 dark:text-red-100 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 dark:hover:bg-red-800 transform hover:scale-105"
    >
        <svg
            stroke="currentColor"
            viewBox="0 0 24 24"
            fill="none"
            class="h-5 w-5 flex-shrink-0 mr-2 text-red-600"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                stroke-width="2"
                stroke-linejoin="round"
                stroke-linecap="round"
            ></path>
        </svg>
        <p class="text-xs font-semibold">{{ $error }}</p>
    </div>

    <script>
        // Fade out the error alert after 3 seconds
        setTimeout(function() {
            const alertBox = document.getElementById('error-alert');
            alertBox.classList.add('opacity-0', 'transition-opacity', 'duration-1000'); // Add classes for fade out
            alertBox.classList.remove('mb-5'); // Optionally remove margin if you want a smoother transition
        }, 3000);
    </script>
@endif


    @if(count($publicTransportLines) > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-2 px-4 text-left">Line Number</th>
                    <th class="py-2 px-4 text-left">Short Distance</th>
                    <th class="py-2 px-4 text-left">Operates on Weekend</th>
                    <th class="py-2 px-4 text-left">Transport Type</th>
                    <th class="py-2 px-4 text-left">Departure Time</th>
                    <th class="py-2 px-4 text-left">Arrival Time</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($publicTransportLines as $line)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="py-2 px-4 border-b">{{ $line['lineNumber']['value'] ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $line['shortDistance']['value'] === 'true' ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b">{{ $line['operatesOnWeekend']['value'] === 'true' ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b">{{ $line['transportType']['value'] ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($line['departureTime']['value'])->format('Y-m-d H:i:s') }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($line['arrivalTime']['value'])->format('Y-m-d H:i:s') }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="#" class="text-blue-500 hover:text-blue-600">Edit</a>
                        <form action="{{ route('public-transport.destroy', ['id' => substr($line['transport']['value'], strrpos($line['transport']['value'], '_') + 1)]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this transport?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No public transport lines available.</p>
    @endif
</div>
@endsection
