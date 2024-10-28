<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav class="bg-green-500 p-4 shadow-lg">
        <div class="container mx-auto">
            <ul class="flex space-x-4 text-white font-semibold">
                <li><a href="{{ route('trafficConditions.index') }}" class="hover:underline">All Traffic Conditions</a></li>
                <li><a href="{{ route('trafficConditions.create') }}" class="hover:underline">Create Traffic Condition</a></li>
                <li><a href="{{ route('chargingStations.index') }}" class="hover:underline">All Charging Stations</a></li>
                <li><a href="{{ route('chargingStations.create') }}" class="hover:underline">Create Charging Station</a></li>
                <li><a href="{{ route('weather.index') }}" class="hover:underline">All Weather Conditions</a></li>
                <li><a href="{{ route('weather.create') }}" class="hover:underline">Create Weather Condition</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>
</body>
</html>
