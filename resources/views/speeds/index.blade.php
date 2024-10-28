@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Speeds</h2>

    @if (session('success'))
    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z" />
            </svg>
            <span class="sr-only">Success icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
        <button type="button" class="ml-auto bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100" onclick="hideToast('toast-success')">
            <span class="sr-only">Close</span>
        </button>
    </div>
    <script>
        setTimeout(() => document.getElementById('toast-success').style.display = 'none', 3000);
    </script>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('speeds.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
            Add New Speed
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-2 px-4 text-left">Speed ID</th>
                    <th class="py-2 px-4 text-left">Speed Value</th>
                    <th class="py-2 px-4 text-left">Fast Speed</th>
                    <th class="py-2 px-4 text-left">Medium Speed</th>
                    <th class="py-2 px-4 text-left">Slow Speed</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($speeds as $speed)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="py-2 px-4 border-b">{{ Str::after($speed['speed']['value'], '#') }}</td>
                    <td class="py-2 px-4 border-b">{{ is_array($speed['speedValue']) ? implode(', ', $speed['speedValue']) : $speed['speedValue'] }}</td>
                    <td class="py-2 px-4 border-b">{{ filter_var($speed['fastSpeed'], FILTER_VALIDATE_BOOLEAN) ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b">{{ filter_var($speed['mediumSpeed'], FILTER_VALIDATE_BOOLEAN) ? 'Yes' : 'Yes' }}</td>
                    <td class="py-2 px-4 border-b">{{ filter_var($speed['slowSpeed'], FILTER_VALIDATE_BOOLEAN) ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <form action="{{ route('speeds.destroy', ['id' => Str::after($speed['speed']['value'], '#')]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No speeds available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection