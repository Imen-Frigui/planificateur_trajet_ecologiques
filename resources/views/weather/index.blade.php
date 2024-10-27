@extends('layout')

@section('title', 'Weather Conditions')

@section('content')
    <h1>Weather Conditions</h1>

    @if(count($weatherConditions) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>Weather Type</th>
                    <th>Sunny</th>
                    <th>Snowy</th>
                    <th>Rainy</th>
                    <th>Temperature</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weatherConditions['results']['bindings'] as $condition)
                    <tr>
                        <td>{{ $condition['weatherType']['value'] }}</td>
                        <td>{{ $condition['sunny']['value'] }}</td>
                        <td>{{ $condition['snowy']['value'] }}</td>
                        <td>{{ $condition['rainy']['value'] }}</td>
                        <td>{{ $condition['temperature']['value'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No weather conditions available.</p>
    @endif
@endsection
