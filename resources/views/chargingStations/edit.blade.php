@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Charging Station</h2>
    
    <form action="{{ route('chargingStations.update', ['uri' => $station['station']['value']]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="chargingSpeed">Charging Speed</label>
            <input type="text" 
                   class="form-control" 
                   id="chargingSpeed" 
                   name="chargingSpeed" 
                   value="{{ $station['chargingSpeed']['value'] }}">
        </div>

        <div class="form-group">
            <label for="fastCharging">Fast Charging</label>
            <select class="form-control" id="fastCharging" name="fastCharging">
                <option value="true" {{ $station['fastCharging']['value'] === 'true' ? 'selected' : '' }}>Yes</option>
                <option value="false" {{ $station['fastCharging']['value'] === 'false' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stationType">Station Type</label>
            <input type="text" 
                   class="form-control" 
                   id="stationType" 
                   name="stationType" 
                   value="{{ $station['stationType']['value'] }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Station</button>
        <a href="{{ route('chargingStations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection