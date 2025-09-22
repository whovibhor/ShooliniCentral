<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'Nest-Shoolini University') }}</title>
    <!-- Fonts: Inter + Saira -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body class="min-h-screen bg-slate-50 text-slate-800">
    <div id="app" class="min-h-screen flex flex-col">
      <!-- Header -->
      <header class="sticky top-0 z-[1000] h-16 flex items-center justify-between px-4 bg-white/80 backdrop-blur border-b border-slate-200">
        <div class="flex items-center gap-3">
          <button id="sc-sidebar-toggle" class="inline-flex items-center justify-center w-10 h-10 rounded-md border border-slate-200 hover:bg-slate-100 transition" aria-label="Toggle sidebar" title="Toggle sidebar (Ctrl+B)">
            <!-- menu icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </button>
          <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold text-slate-900" aria-label="{{ config('app.name') }}">
            <img src="{{ asset('images/bgmainlogo.png') }}" alt="{{ config('app.name') }} logo" class="w-30 h-12 object-contain" onerror="this.style.display='none'" />
          </a>
        </div>
        <div class="hidden md:flex items-center gap-3 min-w-[16rem] flex-1 justify-center">
          <form action="{{ route('search') }}" method="get" role="search" class="relative w-full max-w-xl">
            <label for="site-search" class="sr-only">Search</label>
            <input id="site-search" name="q" type="search" placeholder="Search In Nest" value="{{ request('q') }}" class="h-10 w-full rounded-md border border-slate-200 pl-9 pr-3 outline-none focus:ring-2 focus:ring-sky-500" />
            <span class="pointer-events-none absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
          </form>
        </div>
        <div class="flex items-center gap-4">
          <nav class="hidden md:flex items-center gap-4 text-sm text-slate-700">
            <a href="{{ route('about') }}" class="hover:text-slate-900">About</a>
            <a href="{{ route('contact') }}" class="hover:text-slate-900">Contact</a>
            <a href="{{ route('developer') }}" class="hover:text-slate-900">Developer</a>
          </nav>
          <!-- Notifications -->
          <button class="inline-flex items-center justify-center w-10 h-10 rounded-full hover:bg-slate-100" aria-label="Notifications" title="Notifications">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
          </button>
          <!-- Profile -->
          <div class="w-8 h-8 rounded-full bg-slate-200" title="Profile"></div>
        </div>
      </header>

      <div class="flex flex-1 min-h-0">
        <!-- Sidebar -->
        <aside id="sc-sidebar" class="relative border-r border-slate-200 bg-white transition-[width] duration-200 ease-in-out overflow-hidden">
          <nav class="h-[calc(100vh-4rem)] sticky top-16 overflow-y-auto py-3">
            <ul class="space-y-2">
              <!-- group heading -->
              <li class="px-3 py-2 text-xs uppercase tracking-wide text-slate-500">Main</li>
              <li>@include('partials.navitem', [
                'route' => 'confessions',
                'href' => route('confessions'),
                'label' => 'Confessions',
                'iconPngBw' => 'icons/png/confession bw.png',
                'iconPngCol' => 'icons/png/confession col.png',
              ])</li>
              <li>@include('partials.navitem', [
                'route' => 'marketplace',
                'href' => route('marketplace'),
                'label' => 'Marketplace',
                'iconPngBw' => 'icons/png/marketplace bw.png',
                'iconPngCol' => 'icons/png/marketplace col.png',
              ])</li>
              <li>@include('partials.navitem', [
                'route' => 'events',
                'href' => route('events'),
                'label' => 'Events & Notices',
                'iconPngBw' => 'icons/png/event bw.png',
                'iconPngCol' => 'icons/png/event col.png',
              ])</li>
              <li>@include('partials.navitem', [
                'route' => 'lost-found',
                'href' => route('lost-found'),
                'label' => 'Lost & Found',
                'iconPngBw' => 'icons/png/lost-and-found bw.png',
                'iconPngCol' => 'icons/png/lost-and-found col.png',
              ])</li>

              <li class="mt-5 px-3 py-2 text-xs uppercase tracking-wide text-slate-500">Campus</li>
              <li>@include('partials.navitem', [
                'route' => 'stayconnect',
                'href' => route('stayconnect'),
                'label' => 'StayConnect',
                'iconPngBw' => 'icons/png/house bw.png',
                'iconPngCol' => 'icons/png/house col.png',
              ])</li>
              <li>@include('partials.navitem', [
                'route' => 'carpooling',
                'href' => route('carpooling'),
                'label' => 'Carpooling',
                'iconPngBw' => 'icons/png/carpool bw.png',
                'iconPngCol' => 'icons/png/carpool col.png',
              ])</li>
            </ul>
          </nav>
        </aside>

        <!-- Main content -->
        <main id="sc-main" class="flex-1 min-w-0 p-4 md:p-6">
          @yield('content')
        </main>
      </div>

      <!-- Footer -->
      <footer class="border-t border-slate-200 bg-white/80 backdrop-blur px-4">
        <div class="max-w-7xl mx-auto py-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 text-sm">
          <div class="text-slate-600">
            <div class="font-medium text-slate-800">ShooliniCentral</div>
            <p class="max-w-xl text-slate-500">A student-driven portal to share confessions, discover events, trade in the marketplace, and stay connected across campus. Built to bring the community together.</p>
          </div>
          <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-slate-600">
            <a href="{{ route('about') }}" class="hover:text-slate-900">About</a>
            <a href="{{ route('contact') }}" class="hover:text-slate-900">Contact</a>
            <a href="{{ route('developer') }}" class="hover:text-slate-900">Developer</a>
            <a href="{{ route('sitemap') }}" class="hover:text-slate-900">Sitemap</a>
            <a href="#" class="hover:text-slate-900">Privacy</a>
            <a href="#" class="hover:text-slate-900">Terms</a>
          </nav>
        </div>
        <div class="max-w-7xl mx-auto pb-6 flex items-center justify-between text-xs text-slate-500">
          <div>© {{ date('Y') }} ShooliniCentral • Made by <span class="font-semibold">THE ARCHITECT</span></div>
          <div class="text-slate-400">v{{ config('app.version', '1.0') }}</div>
        </div>
      </footer>
    </div>
  </body>
  @include('partials.sidebar-script')
  <script>
    // Focus search with Ctrl+K (or Cmd+K on macOS)
    window.addEventListener('keydown', function(e) {
      const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
      if ((isMac ? e.metaKey : e.ctrlKey) && e.key.toLowerCase() === 'k') {
        const input = document.getElementById('site-search');
        if (input) {
          e.preventDefault();
          input.focus();
          input.select();
        }
      }
    });
  </script>
</html>
