@extends('layouts.app')

@section('title', 'Tutoring')
@section('hide_header', true)

@section('head')
<style>
/* Tutoring Page - Table View Design */
* { margin: 0; padding: 0; box-sizing: border-box; }

.mp-page {
  background: #000000;
  color: #ffffff;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  min-height: 100vh;
  overflow-x: hidden;
}

/* Reuse header, sidebar, footer styles */
.mp-header { position: fixed; top: 0; left: 0; right: 0; height: 70px; background: #000000; border-bottom: 1px solid #3D0000; display: flex; align-items: center; padding: 0 24px; gap: 24px; z-index: 1000; }
.mp-logo { font-size: 20px; font-weight: 700; color: #ffffff; white-space: nowrap; display: flex; align-items: center; gap: 12px; }
.mp-logo svg { color: #FF0000; width: 32px; height: 32px; }
.mp-search { flex: 1; max-width: 500px; position: relative; }
.mp-search input { width: 100%; height: 42px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 8px; padding: 0 16px 0 44px; color: #ffffff; font-size: 14px; transition: all 200ms ease; }
.mp-search input:focus { outline: none; border-color: #950101; box-shadow: 0 0 0 3px rgba(149,1,1,0.15); transform: translateY(-1px); }
.mp-search input::placeholder { color: #888888; }
.mp-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #888888; width: 20px; height: 20px; }
.mp-actions { display: flex; align-items: center; gap: 16px; margin-left: auto; }
.mp-action-btn { width: 40px; height: 40px; border-radius: 50%; border: 1px solid #3D0000; background: transparent; color: #ffffff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 200ms ease; position: relative; }
.mp-action-btn:hover { background: #1a1a1a; border-color: #950101; }
.mp-action-btn.accent { background: #950101; border-color: #950101; }
.mp-action-btn.accent:hover { background: #FF0000; transform: scale(1.05); }
.mp-badge { position: absolute; top: -4px; right: -4px; width: 18px; height: 18px; background: #FF0000; border-radius: 50%; font-size: 10px; font-weight: 600; display: flex; align-items: center; justify-content: center; border: 2px solid #000000; }
.mp-avatar { width: 40px; height: 40px; border-radius: 50%; border: 2px solid #950101; object-fit: cover; cursor: pointer; }

.mp-sidebar { position: fixed; left: 0; top: 70px; width: 80px; height: calc(100vh - 70px); background: #000000; border-right: 1px solid #3D0000; transition: width 300ms cubic-bezier(0.4, 0, 0.2, 1); z-index: 999; overflow: hidden; }
.mp-sidebar.expanded { width: 280px; }
.mp-sidebar-toggle { position: absolute; top: 12px; left: 50%; transform: translateX(-50%); width: 32px; height: 32px; border: 1px solid #3D0000; border-radius: 6px; background: transparent; color: #ffffff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 200ms ease, border-color 200ms ease, transform 200ms ease; z-index: 10; }
.mp-sidebar-toggle:hover { background: #1a1a1a; border-color: #950101; }
.mp-sidebar-toggle:active { transform: translateX(-50%) scale(0.95); }
.mp-nav { padding: 56px 12px 12px; display: flex; flex-direction: column; gap: 6px; }
.mp-nav-item { height: 48px; display: flex; align-items: center; gap: 16px; padding: 12px 16px; border-radius: 8px; color: #cccccc; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 200ms ease; white-space: nowrap; position: relative; cursor: pointer; }
.mp-nav-item:hover { background: #1a1a1a; color: #ffffff; }
.mp-nav-item.active { background: #0d0d0d; color: #ffffff; border-left: 3px solid #950101; }
.mp-nav-item svg { width: 24px; height: 24px; flex-shrink: 0; }
.mp-nav-label { opacity: 0; transform: translateX(-10px); transition: all 300ms ease; }
.mp-sidebar.expanded .mp-nav-label { opacity: 1; transform: translateX(0); }
.mp-nav-divider { height: 1px; background: #3D0000; margin: 16px 0; }

.mp-main { margin-left: 80px; margin-top: 70px; padding: 16px 24px 24px; min-height: calc(100vh - 70px - 60px); transition: margin-left 300ms cubic-bezier(0.4, 0, 0.2, 1); }
.mp-sidebar.expanded ~ .mp-main { margin-left: 280px; }

.mp-footer { position: fixed; bottom: 0; left: 80px; right: 0; height: 60px; background: #000000; border-top: 1px solid #3D0000; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; transition: left 300ms cubic-bezier(0.4, 0, 0.2, 1); z-index: 100; }
.mp-sidebar.expanded ~ .mp-footer { left: 280px; }
.mp-footer-links { display: flex; gap: 24px; }
.mp-footer-link { color: #cccccc; text-decoration: none; font-size: 14px; transition: color 200ms ease; }
.mp-footer-link:hover { color: #ffffff; }
.mp-footer-link.danger { color: #FF0000; }
.mp-footer-link.danger:hover { color: #FF0000; text-decoration: underline; }
.mp-footer-copyright { color: #888888; font-size: 13px; }

/* Tutoring Specific - Table View */
.tutoring-header { padding: 16px 0; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
.tutoring-title { font-size: 28px; font-weight: 700; color: #ffffff; }
.tutoring-filters { display: flex; gap: 8px; }
.filter-select { padding: 8px 16px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 8px; color: #ffffff; font-size: 14px; cursor: pointer; transition: all 200ms ease; }
.filter-select:focus { outline: none; border-color: #950101; }
.filter-select:hover { border-color: #950101; }

.tutoring-table-wrap { background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; overflow: hidden; margin-bottom: 48px; }
.tutoring-table { width: 100%; border-collapse: collapse; }
.tutoring-table thead { background: #1a1a1a; }
.tutoring-table th { padding: 16px 20px; text-align: left; font-size: 13px; font-weight: 600; color: #888888; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #3D0000; }
.tutoring-table tbody tr { border-bottom: 1px solid #3D0000; transition: all 200ms ease; cursor: pointer; }
.tutoring-table tbody tr:last-child { border-bottom: none; }
.tutoring-table tbody tr:hover { background: #1a1a1a; }
.tutoring-table td { padding: 16px 20px; font-size: 14px; color: #cccccc; vertical-align: middle; }

.tutor-cell { display: flex; align-items: center; gap: 12px; }
.tutor-avatar { width: 48px; height: 48px; border-radius: 50%; border: 2px solid #3D0000; object-fit: cover; }
.tutor-info { display: flex; flex-direction: column; gap: 2px; }
.tutor-name { font-size: 15px; font-weight: 600; color: #ffffff; }
.tutor-dept { font-size: 12px; color: #888888; }

.subject-badge { padding: 6px 12px; background: #1a1a1a; border: 1px solid #3D0000; border-radius: 6px; font-size: 13px; display: inline-block; }

.rating-cell { display: flex; align-items: center; gap: 6px; color: #FFA500; font-weight: 600; }
.rating-cell svg { width: 16px; height: 16px; fill: currentColor; }

.price-cell { font-size: 16px; font-weight: 700; color: #ffffff; }

.status-badge { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; }
.status-badge.available { background: rgba(0,200,83,0.2); color: #00C853; border: 1px solid #00C853; }
.status-badge.busy { background: rgba(255,152,0,0.2); color: #FF9800; border: 1px solid #FF9800; }

.action-btn { padding: 8px 16px; background: transparent; border: 1px solid #950101; border-radius: 6px; color: #950101; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 200ms ease; }
.action-btn:hover { background: #950101; color: #ffffff; }

@media (max-width: 1024px) {
  .mp-main { margin-left: 0; padding: 16px; }
  .mp-footer { left: 0; }
  .tutoring-table-wrap { overflow-x: auto; }
  .tutoring-table { min-width: 800px; }
}
</style>
@endsection

@section('content')
<div class="mp-page">
  <header class="mp-header">
    <div class="mp-logo">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
      Tutoring
    </div>
    <div class="mp-search">
      <svg class="mp-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"/></svg>
      <input type="search" placeholder="Search tutors or subjects...">
    </div>
    <div class="mp-actions">
      <button class="mp-action-btn" title="Notifications">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        <span class="mp-badge">3</span>
      </button>
      <button class="mp-action-btn" title="Messages">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        <span class="mp-badge">5</span>
      </button>
      <button class="mp-action-btn accent" title="Become Tutor">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      </button>
      <img src="https://ui-avatars.com/api/?name=Student&background=950101&color=fff" alt="User" class="mp-avatar">
    </div>
  </header>

  <aside class="mp-sidebar" id="mpSidebar">
    <button class="mp-sidebar-toggle" id="sidebarToggle">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
    <nav class="mp-nav">
      <a href="/dashboard" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg><span class="mp-nav-label">Dashboard</span></a>
      <a href="/marketplace" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg><span class="mp-nav-label">Marketplace</span></a>
      <a href="/marketplace/services" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><span class="mp-nav-label">Services</span></a>
      <a href="/marketplace/rentals" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg><span class="mp-nav-label">My Rentals</span></a>
      <a href="/marketplace/skill-exchange" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg><span class="mp-nav-label">Skill Exchange</span></a>
      <a href="/marketplace/tutoring" class="mp-nav-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg><span class="mp-nav-label">Tutoring</span></a>
      <a href="/marketplace/work-board" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg><span class="mp-nav-label">Work Board</span></a>
      <a href="/marketplace/digital-goods" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg><span class="mp-nav-label">Digital Goods</span></a>
      <div class="mp-nav-divider"></div>
      <a href="/marketplace/profile" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span class="mp-nav-label">Profile</span></a>
      <a href="/marketplace/settings" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg><span class="mp-nav-label">Settings</span></a>
    </nav>
  </aside>

  <main class="mp-main" id="mpMain">
    <div class="tutoring-header">
      <h1 class="tutoring-title">Find a Tutor</h1>
      <div class="tutoring-filters">
        <select class="filter-select">
          <option>All Subjects</option>
          <option>Mathematics</option>
          <option>Physics</option>
          <option>Chemistry</option>
          <option>Computer Science</option>
          <option>English</option>
        </select>
        <select class="filter-select">
          <option>Sort by Rating</option>
          <option>Sort by Price: Low to High</option>
          <option>Sort by Price: High to Low</option>
          <option>Sort by Experience</option>
        </select>
      </div>
    </div>

    <div class="tutoring-table-wrap">
      <table class="tutoring-table">
        <thead>
          <tr>
            <th>Tutor</th>
            <th>Subject</th>
            <th>Rating</th>
            <th>Sessions</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach([
            ['name'=>'Dr. Amit Sharma', 'dept'=>'PhD, Mathematics', 'subject'=>'Calculus & Linear Algebra', 'rating'=>'4.9', 'reviews'=>'124', 'sessions'=>'240', 'price'=>'300', 'status'=>'available'],
            ['name'=>'Priya Verma', 'dept'=>'M.Sc Physics', 'subject'=>'Quantum Physics', 'rating'=>'4.8', 'reviews'=>'98', 'sessions'=>'189', 'price'=>'250', 'status'=>'available'],
            ['name'=>'Rahul Kumar', 'dept'=>'B.Tech CSE', 'subject'=>'Python & Data Structures', 'rating'=>'5.0', 'reviews'=>'156', 'sessions'=>'312', 'price'=>'350', 'status'=>'busy'],
            ['name'=>'Anjali Patel', 'dept'=>'M.A English', 'subject'=>'English Literature', 'rating'=>'4.7', 'reviews'=>'87', 'sessions'=>'165', 'price'=>'200', 'status'=>'available'],
            ['name'=>'Vikram Singh', 'dept'=>'M.Sc Chemistry', 'subject'=>'Organic Chemistry', 'rating'=>'4.9', 'reviews'=>'112', 'sessions'=>'224', 'price'=>'280', 'status'=>'available'],
            ['name'=>'Neha Kapoor', 'dept'=>'B.Tech CSE', 'subject'=>'Web Development', 'rating'=>'4.8', 'reviews'=>'143', 'sessions'=>'286', 'price'=>'320', 'status'=>'busy'],
            ['name'=>'Karan Malhotra', 'dept'=>'M.Sc Mathematics', 'subject'=>'Statistics & Probability', 'rating'=>'5.0', 'reviews'=>'91', 'sessions'=>'182', 'price'=>'290', 'status'=>'available'],
            ['name'=>'Simran Bhatia', 'dept'=>'MBA', 'subject'=>'Economics & Finance', 'rating'=>'4.6', 'reviews'=>'76', 'sessions'=>'152', 'price'=>'260', 'status'=>'available']
          ] as $tutor)
          <tr>
            <td>
              <div class="tutor-cell">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor['name']) }}&background=random&size=48" alt="{{ $tutor['name'] }}" class="tutor-avatar">
                <div class="tutor-info">
                  <span class="tutor-name">{{ $tutor['name'] }}</span>
                  <span class="tutor-dept">{{ $tutor['dept'] }}</span>
                </div>
              </div>
            </td>
            <td><span class="subject-badge">{{ $tutor['subject'] }}</span></td>
            <td>
              <div class="rating-cell">
                <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                {{ $tutor['rating'] }} ({{ $tutor['reviews'] }})
              </div>
            </td>
            <td>{{ $tutor['sessions'] }}</td>
            <td><span class="price-cell">₹{{ $tutor['price'] }}/hr</span></td>
            <td><span class="status-badge {{ $tutor['status'] }}">{{ ucfirst($tutor['status']) }}</span></td>
            <td><button class="action-btn">Book Session</button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>

  <footer class="mp-footer" id="mpFooter">
    <div class="mp-footer-links">
      <a href="/about" class="mp-footer-link">About</a>
      <a href="/help" class="mp-footer-link">Help Center</a>
      <a href="/guidelines" class="mp-footer-link">Community Guidelines</a>
      <a href="/report" class="mp-footer-link danger">Report Issue</a>
    </div>
    <div class="mp-footer-copyright">© 2024 Shoolini Marketplace</div>
  </footer>
</div>
@endsection

@section('scripts')
<script>
(function() {
  const sidebar = document.getElementById('mpSidebar');
  const toggle = document.getElementById('sidebarToggle');

  toggle.addEventListener('click', () => {
    sidebar.classList.toggle('expanded');
    localStorage.setItem('sidebarExpanded', sidebar.classList.contains('expanded'));
  });

  if (localStorage.getItem('sidebarExpanded') === 'true') {
    sidebar.classList.add('expanded');
  }
})();
</script>
@endsection
