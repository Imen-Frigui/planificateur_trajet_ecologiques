<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-green-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white text-lg font-bold">Eco Route Planner</a>
            <div>
                <a href="{{ route('home') }}" class="text-white px-4 hover:bg-green-600 transition">Home</a>
                <a href="{{ route('chargingStations.index') }}" class="text-white px-4 hover:bg-green-600 transition">Charging Stations</a>
                <a href="{{ route('routes.index') }}" class="text-white px-4 hover:bg-green-600 transition">Routes</a>
                <a href="{{ route('weather.index') }}" class="text-white px-4 hover:bg-green-600 transition">All Weather Conditions</a>
                <a href="{{ route('distances.index') }}" class="text-white px-4 hover:bg-green-600 transition">Diffrent distances</a> 
                <a href="{{ route('trafficConditions.index') }}" class="text-white px-4 hover:bg-green-600 transition">Traffic Conditions</a>  

            </div>
        </div>
    </nav>

    <div class="container mx-auto p-6 min-h-screen">
        @yield('content')
    </div>

    <footer class="bg-green-500 text-white text-center p-4">
        <p>&copy; {{ date('Y') }} Eco Route Planner. All Rights Reserved.</p>
    </footer>
</body>
</html>
