@extends('layouts.app')

@section('title', 'Work Board')
@section('hide_header', true)

@section('head')
<style>
/* Work Board Page - Kanban Board Design */
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

/* Work Board Specific - Kanban Layout */
.work-header { padding: 16px 0; margin-bottom: 20px; }
.work-title { font-size: 28px; font-weight: 700; color: #ffffff; margin-bottom: 8px; }
.work-subtitle { font-size: 14px; color: #888888; }

.work-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 32px; }
.work-stat-card { background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; padding: 20px; transition: all 200ms ease; }
.work-stat-card:hover { border-color: #950101; transform: translateY(-2px); }
.work-stat-label { font-size: 13px; color: #888888; margin-bottom: 8px; }
.work-stat-value { font-size: 32px; font-weight: 700; color: #ffffff; }
.work-stat-change { font-size: 12px; color: #00C853; margin-top: 4px; }

.kanban-board { display: flex; gap: 20px; overflow-x: auto; padding-bottom: 48px; }
.kanban-board::-webkit-scrollbar { height: 8px; }
.kanban-board::-webkit-scrollbar-track { background: #0d0d0d; border-radius: 4px; }
.kanban-board::-webkit-scrollbar-thumb { background: #3D0000; border-radius: 4px; }
.kanban-board::-webkit-scrollbar-thumb:hover { background: #950101; }

.kanban-column { min-width: 360px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; padding: 16px; }
.kanban-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #3D0000; }
.kanban-title { font-size: 16px; font-weight: 600; color: #ffffff; display: flex; align-items: center; gap: 8px; }
.kanban-count { display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #1a1a1a; border: 1px solid #3D0000; border-radius: 50%; font-size: 12px; font-weight: 600; color: #888888; }

.kanban-cards { display: flex; flex-direction: column; gap: 12px; max-height: calc(100vh - 320px); overflow-y: auto; padding-right: 4px; }
.kanban-cards::-webkit-scrollbar { width: 4px; }
.kanban-cards::-webkit-scrollbar-thumb { background: #3D0000; border-radius: 2px; }

.work-card { background: #1a1a1a; border: 1px solid #3D0000; border-radius: 10px; padding: 16px; cursor: pointer; transition: all 300ms ease; }
.work-card:hover { border-color: #950101; transform: translateX(4px); box-shadow: 0 8px 24px rgba(149,1,1,0.15); }

.work-card-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px; }
.work-card-type { padding: 4px 10px; background: rgba(149,1,1,0.2); border: 1px solid #950101; border-radius: 4px; font-size: 11px; font-weight: 600; color: #950101; text-transform: uppercase; }
.work-card-price { font-size: 16px; font-weight: 700; color: #ffffff; }

.work-card-title { font-size: 15px; font-weight: 600; color: #ffffff; margin-bottom: 8px; }
.work-card-desc { font-size: 13px; color: #cccccc; line-height: 1.5; margin-bottom: 12px; }

.work-card-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; }
.work-card-tag { padding: 4px 8px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 4px; font-size: 11px; color: #888888; }

.work-card-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid #3D0000; }
.work-card-client { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #888888; }
.work-card-client img { width: 24px; height: 24px; border-radius: 50%; border: 1px solid #3D0000; }
.work-card-meta { display: flex; align-items: center; gap: 12px; font-size: 12px; color: #888888; }
.work-card-meta-item { display: flex; align-items: center; gap: 4px; }
.work-card-meta-item svg { width: 14px; height: 14px; }

@media (max-width: 768px) {
  .mp-main { margin-left: 0; padding: 16px; }
  .mp-footer { left: 0; }
  .kanban-column { min-width: 300px; }
}
</style>
@endsection

@section('content')
<div class="mp-page">
  <header class="mp-header">
    <div class="mp-logo">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Work Board
    </div>
    <div class="mp-search">
      <svg class="mp-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"/></svg>
      <input type="search" placeholder="Search jobs...">
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
      <button class="mp-action-btn accent" title="Post Job">
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
      <a href="/marketplace/tutoring" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg><span class="mp-nav-label">Tutoring</span></a>
      <a href="/marketplace/work-board" class="mp-nav-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg><span class="mp-nav-label">Work Board</span></a>
      <a href="/marketplace/digital-goods" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg><span class="mp-nav-label">Digital Goods</span></a>
      <div class="mp-nav-divider"></div>
      <a href="/marketplace/profile" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span class="mp-nav-label">Profile</span></a>
      <a href="/marketplace/settings" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg><span class="mp-nav-label">Settings</span></a>
    </nav>
  </aside>

  <main class="mp-main" id="mpMain">
    <div class="work-header">
      <h1 class="work-title">Work Board</h1>
      <p class="work-subtitle">Find gigs, freelance work, and part-time opportunities</p>
    </div>

    <div class="work-stats">
      <div class="work-stat-card">
        <div class="work-stat-label">Open Positions</div>
        <div class="work-stat-value">24</div>
        <div class="work-stat-change">+6 this week</div>
      </div>
      <div class="work-stat-card">
        <div class="work-stat-label">Your Applications</div>
        <div class="work-stat-value">8</div>
        <div class="work-stat-change">2 pending review</div>
      </div>
      <div class="work-stat-card">
        <div class="work-stat-label">Active Gigs</div>
        <div class="work-stat-value">12</div>
        <div class="work-stat-change">4 ending soon</div>
      </div>
      <div class="work-stat-card">
        <div class="work-stat-label">Avg. Rate</div>
        <div class="work-stat-value">₹250</div>
        <div class="work-stat-change">per hour</div>
      </div>
    </div>

    <div class="kanban-board">
      <!-- Available Column -->
      <div class="kanban-column">
        <div class="kanban-header">
          <div class="kanban-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Available
          </div>
          <span class="kanban-count">8</span>
        </div>
        <div class="kanban-cards">
          @foreach([
            ['title'=>'Website Redesign', 'type'=>'Design', 'price'=>'5,000', 'desc'=>'Need a complete redesign of college fest website with modern UI/UX', 'tags'=>['UI/UX','Figma','Web'], 'client'=>'Tech Fest', 'time'=>'2 days', 'proposals'=>'12'],
            ['title'=>'Mobile App Development', 'type'=>'Dev', 'price'=>'15,000', 'desc'=>'Build a React Native app for event management', 'tags'=>['React Native','Firebase'], 'client'=>'Events Team', 'time'=>'1 week', 'proposals'=>'8'],
            ['title'=>'Social Media Content', 'type'=>'Marketing', 'price'=>'3,000', 'desc'=>'Create Instagram posts and reels for campus campaign', 'tags'=>['Design','Video'], 'client'=>'Student Council', 'time'=>'3 days', 'proposals'=>'15']
          ] as $work)
          <div class="work-card">
            <div class="work-card-header">
              <span class="work-card-type">{{ $work['type'] }}</span>
              <span class="work-card-price">₹{{ $work['price'] }}</span>
            </div>
            <h3 class="work-card-title">{{ $work['title'] }}</h3>
            <p class="work-card-desc">{{ $work['desc'] }}</p>
            <div class="work-card-tags">
              @foreach($work['tags'] as $tag)
              <span class="work-card-tag">{{ $tag }}</span>
              @endforeach
            </div>
            <div class="work-card-footer">
              <div class="work-card-client">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($work['client']) }}&background=random&size=24" alt="{{ $work['client'] }}">
                {{ $work['client'] }}
              </div>
              <div class="work-card-meta">
                <div class="work-card-meta-item">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  {{ $work['time'] }}
                </div>
                <div class="work-card-meta-item">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                  {{ $work['proposals'] }}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Applied Column -->
      <div class="kanban-column">
        <div class="kanban-header">
          <div class="kanban-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Applied
          </div>
          <span class="kanban-count">5</span>
        </div>
        <div class="kanban-cards">
          @foreach([
            ['title'=>'Logo Design for Startup', 'type'=>'Design', 'price'=>'2,500', 'desc'=>'Modern minimalist logo for tech startup', 'tags'=>['Branding','Illustrator'], 'client'=>'StartupHub', 'time'=>'5 days ago', 'proposals'=>'Applied'],
            ['title'=>'Video Editing', 'type'=>'Video', 'price'=>'4,000', 'desc'=>'Edit promotional video for college admission', 'tags'=>['Premiere','AfterFX'], 'client'=>'Admissions', 'time'=>'3 days ago', 'proposals'=>'Applied']
          ] as $work)
          <div class="work-card">
            <div class="work-card-header">
              <span class="work-card-type">{{ $work['type'] }}</span>
              <span class="work-card-price">₹{{ $work['price'] }}</span>
            </div>
            <h3 class="work-card-title">{{ $work['title'] }}</h3>
            <p class="work-card-desc">{{ $work['desc'] }}</p>
            <div class="work-card-tags">
              @foreach($work['tags'] as $tag)
              <span class="work-card-tag">{{ $tag }}</span>
              @endforeach
            </div>
            <div class="work-card-footer">
              <div class="work-card-client">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($work['client']) }}&background=random&size=24" alt="{{ $work['client'] }}">
                {{ $work['client'] }}
              </div>
              <div class="work-card-meta">
                <div class="work-card-meta-item">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  {{ $work['time'] }}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- In Progress Column -->
      <div class="kanban-column">
        <div class="kanban-header">
          <div class="kanban-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            In Progress
          </div>
          <span class="kanban-count">3</span>
        </div>
        <div class="kanban-cards">
          @foreach([
            ['title'=>'E-commerce Platform', 'type'=>'Dev', 'price'=>'12,000', 'desc'=>'Laravel + Vue.js e-commerce site for campus store', 'tags'=>['Laravel','Vue.js','MySQL'], 'client'=>'Campus Store', 'time'=>'Due in 5 days', 'proposals'=>'60% complete'],
            ['title'=>'Photography', 'type'=>'Creative', 'price'=>'6,000', 'desc'=>'Event photography for annual day function', 'tags'=>['Photography','Editing'], 'client'=>'Annual Fest', 'time'=>'Due in 2 days', 'proposals'=>'80% complete']
          ] as $work)
          <div class="work-card">
            <div class="work-card-header">
              <span class="work-card-type">{{ $work['type'] }}</span>
              <span class="work-card-price">₹{{ $work['price'] }}</span>
            </div>
            <h3 class="work-card-title">{{ $work['title'] }}</h3>
            <p class="work-card-desc">{{ $work['desc'] }}</p>
            <div class="work-card-tags">
              @foreach($work['tags'] as $tag)
              <span class="work-card-tag">{{ $tag }}</span>
              @endforeach
            </div>
            <div class="work-card-footer">
              <div class="work-card-client">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($work['client']) }}&background=random&size=24" alt="{{ $work['client'] }}">
                {{ $work['client'] }}
              </div>
              <div class="work-card-meta">
                <div class="work-card-meta-item">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  {{ $work['time'] }}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Completed Column -->
      <div class="kanban-column">
        <div class="kanban-header">
          <div class="kanban-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Completed
          </div>
          <span class="kanban-count">4</span>
        </div>
        <div class="kanban-cards">
          @foreach([
            ['title'=>'Landing Page Design', 'type'=>'Design', 'price'=>'3,500', 'desc'=>'Modern landing page for college hackathon', 'tags'=>['Figma','Design'], 'client'=>'Hackathon', 'time'=>'Completed', 'proposals'=>'Paid'],
            ['title'=>'Content Writing', 'type'=>'Writing', 'price'=>'2,000', 'desc'=>'Blog posts for college website', 'tags'=>['SEO','Writing'], 'client'=>'College PR', 'time'=>'Completed', 'proposals'=>'Paid']
          ] as $work)
          <div class="work-card">
            <div class="work-card-header">
              <span class="work-card-type">{{ $work['type'] }}</span>
              <span class="work-card-price">₹{{ $work['price'] }}</span>
            </div>
            <h3 class="work-card-title">{{ $work['title'] }}</h3>
            <p class="work-card-desc">{{ $work['desc'] }}</p>
            <div class="work-card-tags">
              @foreach($work['tags'] as $tag)
              <span class="work-card-tag">{{ $tag }}</span>
              @endforeach
            </div>
            <div class="work-card-footer">
              <div class="work-card-client">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($work['client']) }}&background=random&size=24" alt="{{ $work['client'] }}">
                {{ $work['client'] }}
              </div>
              <div class="work-card-meta">
                <div class="work-card-meta-item" style="color: #00C853;">
                  <svg fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>
                  {{ $work['proposals'] }}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
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
