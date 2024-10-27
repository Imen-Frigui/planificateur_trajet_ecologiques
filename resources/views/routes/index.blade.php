@extends('layout')

@section('title', 'Routes')

@section('content')
    <h1>Routes</h1>

    <!-- Display error messages if they exist -->
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (count($routes) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>Route Name</th>
                    <th>CO2 Emission Value</th>
                    <th>Distance Value</th>
                    <th>Duration Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($routes as $route)
                    <tr>
                        <td>
                            {{-- Extract and display only the ID portion after '#' --}}
                            {{ Str::after($route['route']['value'], '#') }}
                        </td>
                        <td>{{ $route['co2EmissionValue']['value'] ?? 'N/A' }}</td>
                        <td>{{ $route['distanceValue']['value'] ?? 'N/A' }}</td>
                        <td>{{ $route['durationValue']['value'] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No routes available.</p>
    @endif
@endsection
