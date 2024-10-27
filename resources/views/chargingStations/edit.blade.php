{{-- resources/views/chargingStations/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Charging Station</h1>

    <form action="{{ route('chargingStations.update', ['uri' => $station['station']['value']]) }}" method="POST" class="space-y-4">
    @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="stationType" class="block text-gray-700 font-bold mb-2">Station Type</label>
            <input type="text" 
                   name="stationType" 
                   id="stationType" 
                   value="{{ $station['stationType'] }}" 
                   class="w-full px-3 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label for="chargingSpeed" class="block text-gray-700 font-bold mb-2">Charging Speed</label>
            <input type="number" 
                   step="0.1" 
                   name="chargingSpeed" 
                   id="chargingSpeed" 
                   value="{{ $station['chargingSpeed'] }}" 
                   class="w-full px-3 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label for="fastCharging" class="block text-gray-700 font-bold mb-2">Fast Charging</label>
            <select name="fastCharging" 
                    id="fastCharging" 
                    class="w-full px-3 py-2 border rounded-lg">
                <option value="true" {{ $station['fastCharging'] === 'true' ? 'selected' : '' }}>Yes</option>
                <option value="false" {{ $station['fastCharging'] === 'false' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Update Station
            </button>
            <a href="{{ route('chargingStations.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection