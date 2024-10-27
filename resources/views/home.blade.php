@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto p-6 bg-gradient-to-r from-green-400 to-blue-500 rounded-lg shadow-lg">
        <h1 class="text-5xl font-bold text-center text-white mb-4">Welcome to Eco Route Planner</h1>
        <p class="text-lg text-center text-white mb-8">Plan your eco-friendly routes and find charging stations along the way!</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-3xl font-semibold mb-2 text-green-600">🌱 Find Charging Stations</h2>
                <p class="text-gray-700">Discover the nearest charging stations on your route, ensuring a seamless and eco-friendly travel experience.</p>
                <a href="{{ route('chargingStations.index') }}" class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">Explore Now</a>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-3xl font-semibold mb-2 text-green-600">🚗 Plan Your Route</h2>
                <p class="text-gray-700">Plan your journey with optimized routes that minimize carbon emissions and enhance efficiency.</p>
                <a href="{{ route('vehicle.index') }}" class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">Choose a Vheicle</a>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-3xl font-semibold mb-2 text-green-600">🌦️ Real-time Weather Updates</h2>
                <p class="text-gray-700">Stay informed with real-time weather updates, helping you to plan your trip accordingly.</p>
                <a href="{{ route('weather.index') }}" class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">Check Weather</a>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-4xl font-semibold text-center text-white mb-4">Features</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-300 text-lg">
                <li class="flex items-center">
                    <span class="mr-2">🌍</span> Find the nearest charging stations.
                </li>
                <li class="flex items-center">
                    <span class="mr-2">🔋</span> Plan eco-friendly routes.
                </li>
                <li class="flex items-center">
                    <span class="mr-2">☀️</span> Get real-time weather updates.
                </li>
                <li class="flex items-center">
                    <span class="mr-2">♻️</span> Explore sustainable transportation options.
                </li>
            </ul>
        </div>

        <div class="mt-8 p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-green-600">Join Us in Making a Difference</h2>
            <p class="text-gray-700 mb-4">Our platform is designed to promote sustainable travel. By planning your routes and using electric charging stations, you can contribute to a greener planet.</p>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection
