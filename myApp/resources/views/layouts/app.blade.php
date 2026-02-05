<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BookBus')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container nav-flex">
            <a href="/" class="logo">BookBus</a>
            <nav style="display: flex; align-items: center; gap: 1rem;">
                <a href="{{ route('search.index') }}" class="btn btn-primary"
                    style="padding: 0.5rem 1rem; font-size: 0.9rem;">Book Now</a>

                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn"
                            style="background: transparent; color: var(--text-main); padding: 0.5rem 1rem; font-size: 0.9rem; border: 1px solid var(--glass-border);">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn"
                        style="background: transparent; color: var(--text-main); padding: 0.5rem 1rem; font-size: 0.9rem; border: 1px solid var(--glass-border);">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container text-center" style="padding: 2rem 0; color: var(--text-muted);">
            &copy; {{ date('Y') }} BookBus. All rights reserved.
        </div>
    </footer>
</body>

</html>