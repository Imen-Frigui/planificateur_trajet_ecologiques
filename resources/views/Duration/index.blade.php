@extends('layouts.app')

@section('title', 'Duration Management')

@section('content')
<script src="{{ asset('resources/js/deleteDuration.js') }}"></script>

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Duration Management</h2>

        <div class="mb-4">
            <a href="{{ route('duration.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">Add Duration</a>
        </div>

        @if(session('success'))
            <div id="success-alert" class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div id="error-alert" class="bg-red-500 text-white p-4 rounded-lg mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(count($durations) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="py-2 px-4 text-left">Exact Duration (min)</th>
                            <th class="py-2 px-4 text-left">Long Duration</th>
                            <th class="py-2 px-4 text-left">Medium Duration</th>
                            <th class="py-2 px-4 text-left">Short Duration</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($durations as $duration)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="py-2 px-4 border-b">{{ $duration['exactDuration']['value'] ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">{{ $duration['longDuration']['value'] ? 'Yes' : 'No' }}</td>
                                <td class="py-2 px-4 border-b">{{ $duration['mediumDuration']['value'] ? 'Yes' : 'No' }}</td>
                                <td class="py-2 px-4 border-b">{{ $duration['shortDuration']['value'] ? 'Yes' : 'No' }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="#" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    <form action="{{ route('duration.destroy', ['id' => substr($duration['duration']['value'], strrpos($duration['duration']['value'], '_') + 1)]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this duration?');">
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
            <p>No durations available.</p>
        @endif
    </div>

    <script>
        function showDeleteAlert() {
            // Create a temporary success alert
            const alertBox = document.createElement('div');
            alertBox.className = "bg-green-500 text-white p-4 rounded-lg mb-4";
            alertBox.innerText = "Duration deleted successfully!";
            document.querySelector('.container').prepend(alertBox);

            // Fade out the alert after 3 seconds
            setTimeout(function() {
                alertBox.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
                alertBox.remove(); // Remove it from DOM after fading out
            }, 3000);
        }
    </script>
@endsection
