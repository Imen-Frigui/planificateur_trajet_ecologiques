@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Add Distance</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('distances.store') }}" method="POST">
            @csrf
          
            <div class="mb-4">
                <label for="exactDistance" class="block text-sm font-medium text-gray-700">Exact Distance</label>
                <input type="number" name="exactDistance" id="exactDistance" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>

            <div class="mb-4">
                <label for="longDistance" class="block text-sm font-medium text-gray-700">Long Distance</label>
                <select name="longDistance" id="longDistance" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="1">TRUE</option>
                    <option value="0">FALSE</option>
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Create Distance
            </button>
        </form>
    </div>
@endsection
