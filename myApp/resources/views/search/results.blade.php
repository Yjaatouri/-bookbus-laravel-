@extends('layouts.app')

@section('title', 'Search Results - BookBus')

@section('content')
    <div class="container animate-fade-in">
        <div class="text-center mt-4" style="margin-bottom: 3rem;">
            <h2>Trips from {{ $from }} to {{ $to }}</h2>
            <p style="color: var(--text-muted);">{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</p>
        </div>

        @if($results->isEmpty())
            <div class="glass-card text-center" style="max-width: 500px; margin: 0 auto;">
                <p style="font-size: 1.25rem;">No trips found for this route on this date.</p>
                <a href="{{ route('search.index') }}" class="btn btn-primary mt-4">Try another search</a>
            </div>
        @else
            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($results as $result)
                    <div class="result-card">
                        <div style="flex: 1;">
                            <h4 style="margin-bottom: 0.25rem; color: var(--primary);">{{ $result['departure_time'] }}</h4>
                            <div style="font-weight: 500;">
                                {{ $result['from_station'] }} <span
                                    style="color: var(--text-muted); padding: 0 0.5rem;">&rarr;</span> {{ $result['to_station'] }}
                            </div>
                            <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem;">
                                {{ $result['route']->nom_route }} • {{ $result['duration'] }}
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div class="price-tag">{{ number_format($result['price'], 0) }} DH</div>
                            <button class="btn btn-primary mt-4" style="padding: 0.5rem 1.5rem;">Select</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection