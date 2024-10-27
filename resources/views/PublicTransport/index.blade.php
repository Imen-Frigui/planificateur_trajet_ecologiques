@extends('layouts.app')

@section('title', 'Public Transport')

@section('content')

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Public Transport</h2>

        <div class="mb-4">
        <a href="{{ route('public-transport.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">Add Transport</a>
</div>
        @if(isset($error))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ $error }}
            </div>
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
