<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') • Shoolini Central</title>
    <!-- Remix Icon Webfont -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('head')
    <meta name="color-scheme" content="dark light">
    <meta name="theme-color" content="#0b0b0f">
</head>
<body class="theme-dark">
    <a class="skip-link" href="#main">Skip to main content</a>
    <div id="app" class="app">
        @include('partials.dashboard.sidebar')
        @include('partials.dashboard.header')

        <div class="content" role="region" aria-label="Scrollable content">
            <main id="main" class="main" tabindex="-1" aria-label="Main content">
                @yield('content')
            </main>

            @include('partials.dashboard.footer')
        </div>
    </div>

    <script defer src="{{ asset('js/dashboard.js') }}"></script>
    @yield('scripts')
</body>
</html>
