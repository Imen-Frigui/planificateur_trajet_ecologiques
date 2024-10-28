{{-- resources/views/trafficConditions/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Traffic Condition</h1>

    <form action="{{ route('trafficConditions.update', ['id' => $trafficCondition['conditionURI']['value']]) }}" method="POST" class="space-y-4">
    @csrf
        @method('PUT')

    

        <div class="mb-4">
            <label for="trafficLevel" class="block text-gray-700 font-bold mb-2">traffic Level</label>
            <select name="trafficLevel" 
                    id="trafficLevel" 
                    class="w-full px-3 py-2 border rounded-lg">
                <option value="high" {{ $trafficCondition['trafficLevel']['value'] === 'high' ? 'selected' : '' }}>High</option>
                <option value="moderate" {{ $trafficCondition['trafficLevel']['value'] === 'moderate' ? 'selected' : '' }}>Moderate</option>
                <option value="low" {{ $trafficCondition['trafficLevel']['value'] === 'low' ? 'selected' : '' }}>Low</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="averageDelay" class="block text-gray-700 font-bold mb-2">Average Delay (minutes)</label>
            <input type="number" 
                   step="1" 
                   name="averageDelay" 
                   id="averageDelay" 
                   value="{{ $trafficCondition['averageDelay']['value'] }}" 
                   class="w-full px-3 py-2 border rounded-lg">
        </div>

        

        <div class="flex justify-between">
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Update Condition
            </button>
            <a href="{{ route('trafficConditions.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
