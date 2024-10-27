@extends('layout')

@section('title', 'Create Weather Condition')

@section('content')
    <h1>Create Weather Condition</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('weather.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="weatherType">Weather Type</label>
            <input type="text" name="weatherType" id="weatherType" class="form-control" value="{{ old('weatherType') }}" required>
        </div>

        <div class="form-group">
            <label for="sunny">Sunny</label>
            <select name="sunny" id="sunny" class="form-control" required>
                <option value="1" {{ old('sunny') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('sunny') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="snowy">Snowy</label>
            <select name="snowy" id="snowy" class="form-control" required>
                <option value="1" {{ old('snowy') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('snowy') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="rainy">Rainy</label>
            <select name="rainy" id="rainy" class="form-control" required>
                <option value="1" {{ old('rainy') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('rainy') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="temperature">Temperature</label>
            <input type="number" name="temperature" id="temperature" class="form-control" step="0.1" value="{{ old('temperature') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Weather Condition</button>
    </form>
@endsection
