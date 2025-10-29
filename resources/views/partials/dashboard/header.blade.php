<header class="header" role="banner">
  <button class="icon-btn sidebar-toggle" id="sidebarToggle" aria-label="Toggle navigation" aria-expanded="true">
    <i class="ri-menu-fold-line"></i>
  </button>

  <nav class="topnav" aria-label="Primary">
    <a href="{{ route('home') }}" class="topnav-link" aria-current="page">
      <i class="ri-home-5-line"></i>
      <span>Home</span>
    </a>
    <a href="{{ route('dashboard') }}" class="topnav-link">
      <i class="ri-dashboard-2-line"></i>
      <span>Dashboard</span>
    </a>
    <a href="/explore" class="topnav-link">
      <i class="ri-compass-3-line"></i>
      <span>Explore</span>
    </a>
    <a href="#" class="topnav-link" title="Notifications">
      <i class="ri-notification-3-line"></i>
      <span class="sr-only">Notifications</span>
      <span class="badge" aria-hidden="true"></span>
    </a>
  </nav>

  <div class="header-actions">
    <label class="search">
      <i class="ri-search-line"></i>
      <input type="search" placeholder="Search…" aria-label="Search" />
    </label>
    <div class="avatar" role="button" tabindex="0" aria-haspopup="menu" aria-label="Account">
      <img src="https://i.pravatar.cc/64?img=5" alt="User avatar" />
    </div>
  </div>
</header>
