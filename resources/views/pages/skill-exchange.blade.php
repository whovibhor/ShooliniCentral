@extends('layouts.app')

@section('title', 'Skill Exchange')
@section('hide_header', true)

@section('head')
<style>
/* Skill Exchange Page - Card Timeline Design */
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

/* Skill Exchange Specific - Timeline Cards */
.skill-header { padding: 16px 0; margin-bottom: 24px; }
.skill-title { font-size: 28px; font-weight: 700; color: #ffffff; margin-bottom: 8px; }
.skill-subtitle { font-size: 14px; color: #888888; }

.skill-tabs { display: flex; gap: 8px; margin-bottom: 32px; border-bottom: 1px solid #3D0000; padding-bottom: 12px; }
.skill-tab { padding: 10px 20px; background: transparent; border: none; color: #888888; font-size: 15px; font-weight: 500; cursor: pointer; transition: all 200ms ease; position: relative; }
.skill-tab::after { content: ''; position: absolute; bottom: -13px; left: 0; width: 0; height: 2px; background: #950101; transition: width 300ms ease; }
.skill-tab:hover { color: #ffffff; }
.skill-tab.active { color: #ffffff; }
.skill-tab.active::after { width: 100%; }

.exchange-timeline { max-width: 900px; margin: 0 auto 48px; }
.exchange-item { display: flex; gap: 24px; margin-bottom: 32px; position: relative; }
.exchange-item::before { content: ''; position: absolute; left: 47px; top: 80px; bottom: -32px; width: 2px; background: linear-gradient(180deg, #3D0000 0%, transparent 100%); }
.exchange-item:last-child::before { display: none; }

.exchange-avatar-wrap { flex-shrink: 0; position: relative; }
.exchange-avatar { width: 96px; height: 96px; border-radius: 50%; border: 3px solid #3D0000; object-fit: cover; transition: all 300ms ease; }
.exchange-item:hover .exchange-avatar { border-color: #950101; transform: scale(1.05); }
.exchange-status { position: absolute; bottom: 4px; right: 4px; width: 24px; height: 24px; background: #00FF00; border-radius: 50%; border: 3px solid #000000; }

.exchange-card { flex: 1; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 16px; padding: 24px; transition: all 300ms ease; cursor: pointer; }
.exchange-card:hover { border-color: #950101; transform: translateY(-4px); box-shadow: 0 12px 32px rgba(149,1,1,0.2); }

.exchange-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px; }
.exchange-user { font-size: 18px; font-weight: 700; color: #ffffff; margin-bottom: 4px; }
.exchange-time { font-size: 13px; color: #888888; }
.exchange-match-score { padding: 6px 12px; background: rgba(149,1,1,0.2); border: 1px solid #950101; border-radius: 6px; font-size: 12px; font-weight: 600; color: #950101; }

.exchange-offer { display: flex; align-items: center; gap: 20px; margin-bottom: 20px; }
.exchange-skill-box { flex: 1; background: #1a1a1a; border: 1px solid #3D0000; border-radius: 10px; padding: 16px; }
.exchange-label { font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
.exchange-skill-name { font-size: 16px; font-weight: 600; color: #ffffff; margin-bottom: 4px; }
.exchange-skill-level { font-size: 13px; color: #cccccc; }
.exchange-arrow { color: #950101; flex-shrink: 0; }
.exchange-arrow svg { width: 24px; height: 24px; }

.exchange-description { color: #cccccc; font-size: 14px; line-height: 1.6; margin-bottom: 16px; }

.exchange-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
.exchange-tag { padding: 4px 12px; background: #1a1a1a; border: 1px solid #3D0000; border-radius: 24px; font-size: 12px; color: #cccccc; }

.exchange-actions { display: flex; gap: 12px; margin-top: 16px; padding-top: 16px; border-top: 1px solid #3D0000; }
.exchange-btn { flex: 1; padding: 10px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 200ms ease; }
.exchange-btn.primary { background: #950101; color: #ffffff; border: none; }
.exchange-btn.primary:hover { background: #FF0000; transform: translateY(-2px); }
.exchange-btn.secondary { background: transparent; color: #888888; border: 1px solid #3D0000; }
.exchange-btn.secondary:hover { border-color: #950101; color: #ffffff; }

@media (max-width: 768px) {
  .mp-main { margin-left: 0; padding: 16px; }
  .mp-footer { left: 0; }
  .exchange-item { flex-direction: column; }
  .exchange-item::before { display: none; }
  .exchange-offer { flex-direction: column; }
  .exchange-arrow { transform: rotate(90deg); }
}
</style>
@endsection

@section('content')
<div class="mp-page">
  <header class="mp-header">
    <div class="mp-logo">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
      Skill Exchange
    </div>
    <div class="mp-search">
      <svg class="mp-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"/></svg>
      <input type="search" placeholder="Search skills...">
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
      <button class="mp-action-btn accent" title="Post Exchange">
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
      <a href="/marketplace/skill-exchange" class="mp-nav-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg><span class="mp-nav-label">Skill Exchange</span></a>
      <a href="/marketplace/tutoring" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg><span class="mp-nav-label">Tutoring</span></a>
      <a href="/marketplace/work-board" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg><span class="mp-nav-label">Work Board</span></a>
      <a href="/marketplace/digital-goods" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg><span class="mp-nav-label">Digital Goods</span></a>
      <div class="mp-nav-divider"></div>
      <a href="/marketplace/profile" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span class="mp-nav-label">Profile</span></a>
      <a href="/marketplace/settings" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg><span class="mp-nav-label">Settings</span></a>
    </nav>
  </aside>

  <main class="mp-main" id="mpMain">
    <div class="skill-header">
      <h1 class="skill-title">Skill Exchange</h1>
      <p class="skill-subtitle">Learn new skills by teaching what you know</p>
    </div>

    <div class="skill-tabs">
      <button class="skill-tab active">All Exchanges</button>
      <button class="skill-tab">My Matches</button>
      <button class="skill-tab">Active</button>
      <button class="skill-tab">Completed</button>
    </div>

    <div class="exchange-timeline">
      @foreach([
        ['user'=>'Priya Sharma', 'time'=>'2 hours ago', 'offering'=>'Web Design', 'offering_level'=>'Expert', 'seeking'=>'Python Programming', 'seeking_level'=>'Beginner', 'match'=>'85%', 'desc'=>'I have 3 years of experience in UI/UX design and looking to learn Python for data analysis. Can teach Figma, Adobe XD, and modern design principles.', 'tags'=>['UI/UX','Figma','Adobe XD']],
        ['user'=>'Rahul Verma', 'time'=>'5 hours ago', 'offering'=>'Guitar Lessons', 'offering_level'=>'Intermediate', 'seeking'=>'Photography', 'seeking_level'=>'Basics', 'match'=>'72%', 'desc'=>'Been playing guitar for 5 years, can teach chords, strumming patterns, and music theory. Want to learn photography basics and composition.', 'tags'=>['Music','Guitar','Teaching']],
        ['user'=>'Anjali Patel', 'time'=>'1 day ago', 'offering'=>'Content Writing', 'offering_level'=>'Professional', 'seeking'=>'Video Editing', 'seeking_level'=>'Intermediate', 'match'=>'90%', 'desc'=>'Professional content writer and blogger. Looking to learn video editing for creating YouTube content. Can teach SEO writing, copywriting, and storytelling.', 'tags'=>['Writing','SEO','Copywriting']],
        ['user'=>'Vikram Singh', 'time'=>'1 day ago', 'offering'=>'Data Science', 'offering_level'=>'Advanced', 'seeking'=>'Public Speaking', 'seeking_level'=>'Intermediate', 'match'=>'68%', 'desc'=>'Data scientist with ML expertise. Want to improve public speaking and presentation skills for conferences. Can teach Python, ML algorithms, and data viz.', 'tags'=>['Python','ML','Data Science']],
        ['user'=>'Neha Kapoor', 'time'=>'2 days ago', 'offering'=>'Digital Marketing', 'offering_level'=>'Expert', 'seeking'=>'Graphic Design', 'seeking_level'=>'Beginner', 'match'=>'78%', 'desc'=>'Certified digital marketer. Looking to learn graphic design to create my own campaign visuals. Can teach social media strategy, ads, and analytics.', 'tags'=>['Marketing','Social Media','Ads']]
      ] as $exchange)
      <div class="exchange-item">
        <div class="exchange-avatar-wrap">
          <img src="https://ui-avatars.com/api/?name={{ urlencode($exchange['user']) }}&background=random&size=96" alt="{{ $exchange['user'] }}" class="exchange-avatar">
          <span class="exchange-status"></span>
        </div>
        <div class="exchange-card">
          <div class="exchange-header">
            <div>
              <div class="exchange-user">{{ $exchange['user'] }}</div>
              <div class="exchange-time">{{ $exchange['time'] }}</div>
            </div>
            <div class="exchange-match-score">{{ $exchange['match'] }} Match</div>
          </div>

          <div class="exchange-offer">
            <div class="exchange-skill-box">
              <div class="exchange-label">Offering</div>
              <div class="exchange-skill-name">{{ $exchange['offering'] }}</div>
              <div class="exchange-skill-level">{{ $exchange['offering_level'] }}</div>
            </div>
            <div class="exchange-arrow">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <div class="exchange-skill-box">
              <div class="exchange-label">Seeking</div>
              <div class="exchange-skill-name">{{ $exchange['seeking'] }}</div>
              <div class="exchange-skill-level">{{ $exchange['seeking_level'] }}</div>
            </div>
          </div>

          <p class="exchange-description">{{ $exchange['desc'] }}</p>

          <div class="exchange-tags">
            @foreach($exchange['tags'] as $tag)
            <span class="exchange-tag">{{ $tag }}</span>
            @endforeach
          </div>

          <div class="exchange-actions">
            <button class="exchange-btn primary">Connect & Exchange</button>
            <button class="exchange-btn secondary">View Profile</button>
          </div>
        </div>
      </div>
      @endforeach
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

  document.querySelectorAll('.skill-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.skill-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
    });
  });
})();
</script>
@endsection
