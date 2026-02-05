@extends('layouts.app')

@section('title', 'Find Your Trip - BookBus')

@section('content')
    <div class="container animate-fade-in" style="max-width: 600px;">
        <div class="glass-card mt-8">
            <h1 class="text-center" style="font-size: 2rem; margin-bottom: 2rem;">Where to next?</h1>

            <form action="{{ route('search.results') }}" method="GET">
                <div class="form-group">
                    <label for="city_from" class="form-label">Departure City</label>
                    <select name="city_from" id="city_from" class="form-select" required>
                        <option value="" disabled selected>Select origin...</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="city_to" class="form-label">Destination City</label>
                    <select name="city_to" id="city_to" class="form-select" required>
                        <option value="" disabled selected>Select destination...</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date" class="form-label">Travel Date</label>
                    <input type="date" name="date" id="date" class="form-input" min="{{ date('Y-m-d') }}"
                        value="{{ date('Y-m-d') }}" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                    Search Tickets
                </button>
            </form>
        </div>
    </div>
@endsection