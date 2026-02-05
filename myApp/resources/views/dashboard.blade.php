@extends('layouts.app')

@section('title', 'Dashboard - BookBus')

@section('content')
    <div class="container" style="margin-top: 4rem;">
        <div class="glass-card animate-fade-in">
            <h1 class="mb-4">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-muted">You are logged in to BookBus. This is your personal dashboard.</p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                <div class="glass-card" style="padding: 1.5rem;">
                    <h3 class="mb-2">Your Reservations</h3>
                    <p class="text-muted">You have no active reservations at the moment.</p>
                    <a href="{{ route('search.index') }}" class="btn btn-primary mt-4"
                        style="display: inline-block; margin-top: 1rem;">Book a Bus</a>
                </div>

                <div class="glass-card" style="padding: 1.5rem;">
                    <h3 class="mb-2">Profile Information</h3>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not provided' }}</p>
                    <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection