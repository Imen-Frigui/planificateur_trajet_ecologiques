<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('weather.index') }}">All Weather Conditions</a></li>
            <li><a href="{{ route('weather.create') }}">Create Weather Condition</a></li>
            <li><a href="{{ route('distances.index') }}">Distances</a></li>

        </ul>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
