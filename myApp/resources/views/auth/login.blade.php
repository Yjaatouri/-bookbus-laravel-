@extends('layouts.app')

@section('title', 'Login - BookBus')

@section('content')
    <div class="container" style="max-width: 500px; margin-top: 4rem;">
        <div class="glass-card animate-fade-in">
            <h2 class="text-center" style="margin-bottom: 2rem;">Welcome Back</h2>

            @if ($errors->any())
                <div
                    style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; color: #b91c1c; font-size: 0.875rem;">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required
                        autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-input" required>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="remember" id="remember" style="width: auto; cursor: pointer;">
                    <label for="remember" class="form-label" style="margin-bottom: 0; cursor: pointer;">Remember me</label>
                </div>

                <div class="mt-8">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
                </div>
            </form>

            <div class="text-center mt-4" style="font-size: 0.875rem; color: var(--text-muted);">
                Don't have an account? <a href="#"
                    style="color: var(--primary); text-decoration: none; font-weight: 600;">Contact Support</a>
            </div>
        </div>
    </div>
@endsection