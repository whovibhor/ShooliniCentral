@extends('layouts.app')

@section('title', 'Profile')
@section('hide_header', true)

@section('head')
<style>
/* Profile Page - Comprehensive Layout */
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

.mp-main { margin-left: 80px; margin-top: 70px; padding: 16px 24px 80px; min-height: calc(100vh - 70px); transition: margin-left 300ms cubic-bezier(0.4, 0, 0.2, 1); }
.mp-sidebar.expanded ~ .mp-main { margin-left: 280px; }

.mp-footer { position: fixed; bottom: 0; left: 80px; right: 0; height: 60px; background: #000000; border-top: 1px solid #3D0000; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; transition: left 300ms cubic-bezier(0.4, 0, 0.2, 1); z-index: 100; }
.mp-sidebar.expanded ~ .mp-footer { left: 280px; }
.mp-footer-links { display: flex; gap: 24px; }
.mp-footer-link { color: #cccccc; text-decoration: none; font-size: 14px; transition: color 200ms ease; }
.mp-footer-link:hover { color: #ffffff; }
.mp-footer-link.danger { color: #FF0000; }
.mp-footer-link.danger:hover { color: #FF0000; text-decoration: underline; }
.mp-footer-copyright { color: #888888; font-size: 13px; }

/* Profile Specific Styles */
.profile-banner { height: 200px; background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border-radius: 16px; margin-bottom: -80px; position: relative; overflow: hidden; }
.profile-banner::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(149,1,1,0.1) 0%, transparent 100%); }

.profile-info-section { display: flex; gap: 32px; align-items: end; margin-bottom: 32px; position: relative; z-index: 1; }
.profile-avatar-wrap { flex-shrink: 0; }
.profile-avatar-large { width: 160px; height: 160px; border-radius: 50%; border: 4px solid #000000; object-fit: cover; background: #0d0d0d; box-shadow: 0 8px 24px rgba(0,0,0,0.5); }
.profile-details { flex: 1; padding-top: 100px; }
.profile-name { font-size: 32px; font-weight: 700; color: #ffffff; margin-bottom: 6px; }
.profile-username { font-size: 16px; color: #888888; margin-bottom: 12px; }
.profile-bio { font-size: 14px; color: #cccccc; line-height: 1.6; max-width: 600px; margin-bottom: 16px; }
.profile-meta { display: flex; gap: 24px; flex-wrap: wrap; }
.profile-meta-item { display: flex; align-items: center; gap: 6px; font-size: 14px; color: #888888; }
.profile-meta-item svg { width: 16px; height: 16px; }
.profile-actions { display: flex; gap: 12px; padding-top: 100px; }
.profile-btn { padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 200ms ease; }
.profile-btn.primary { background: #950101; color: #ffffff; border: none; }
.profile-btn.primary:hover { background: #FF0000; transform: translateY(-2px); }
.profile-btn.secondary { background: transparent; color: #ffffff; border: 1px solid #3D0000; }
.profile-btn.secondary:hover { border-color: #950101; }

.profile-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 32px; }
.stat-card { background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; padding: 20px; transition: all 200ms ease; }
.stat-card:hover { border-color: #950101; transform: translateY(-4px); }
.stat-label { font-size: 13px; color: #888888; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
.stat-value { font-size: 36px; font-weight: 700; color: #ffffff; margin-bottom: 4px; }
.stat-change { font-size: 12px; color: #00C853; }

.profile-tabs { display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid #3D0000; }
.profile-tab { padding: 12px 24px; background: transparent; border: none; color: #888888; font-size: 15px; font-weight: 500; cursor: pointer; transition: all 200ms ease; position: relative; }
.profile-tab::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 0; height: 2px; background: #950101; transition: width 300ms ease; }
.profile-tab:hover { color: #ffffff; }
.profile-tab.active { color: #ffffff; }
.profile-tab.active::after { width: 100%; }
.tab-count { display: inline-flex; align-items: center; justify-content: center; min-width: 20px; height: 20px; padding: 0 6px; background: #1a1a1a; border-radius: 10px; font-size: 11px; margin-left: 8px; }

.profile-content { display: none; }
.profile-content.active { display: block; }

.listings-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
.listing-card { background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; overflow: hidden; transition: all 300ms ease; cursor: pointer; }
.listing-card:hover { border-color: #950101; transform: translateY(-4px); box-shadow: 0 12px 28px rgba(149,1,1,0.2); }
.listing-image { width: 100%; height: 180px; object-fit: cover; background: #1a1a1a; }
.listing-body { padding: 16px; }
.listing-category { font-size: 11px; color: #888888; text-transform: uppercase; margin-bottom: 6px; }
.listing-title { font-size: 16px; font-weight: 600; color: #ffffff; margin-bottom: 8px; }
.listing-price { font-size: 18px; font-weight: 700; color: #ffffff; }
.listing-status { display: inline-block; padding: 4px 10px; background: rgba(0,200,83,0.2); border: 1px solid #00C853; border-radius: 4px; font-size: 11px; font-weight: 600; color: #00C853; margin-top: 12px; }
.listing-status.sold { background: rgba(255,0,0,0.2); border-color: #FF0000; color: #FF0000; }

.activity-list { display: flex; flex-direction: column; gap: 16px; }
.activity-item { display: flex; gap: 16px; padding: 16px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; transition: all 200ms ease; }
.activity-item:hover { border-color: #950101; }
.activity-icon { width: 48px; height: 48px; flex-shrink: 0; background: #1a1a1a; border: 1px solid #3D0000; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
.activity-icon svg { width: 24px; height: 24px; color: #950101; }
.activity-content { flex: 1; }
.activity-title { font-size: 15px; font-weight: 600; color: #ffffff; margin-bottom: 4px; }
.activity-desc { font-size: 13px; color: #cccccc; margin-bottom: 6px; }
.activity-time { font-size: 12px; color: #888888; }

.reviews-list { display: flex; flex-direction: column; gap: 16px; }
.review-card { padding: 20px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; }
.review-header { display: flex; gap: 12px; margin-bottom: 12px; }
.review-avatar { width: 48px; height: 48px; border-radius: 50%; border: 2px solid #3D0000; }
.review-info { flex: 1; }
.review-name { font-size: 15px; font-weight: 600; color: #ffffff; }
.review-rating { display: flex; gap: 4px; margin-top: 4px; }
.review-rating svg { width: 14px; height: 14px; fill: #FFA500; }
.review-date { font-size: 12px; color: #888888; }
.review-text { font-size: 14px; color: #cccccc; line-height: 1.6; }

@media (max-width: 1024px) {
  .mp-main { margin-left: 0; padding: 16px 16px 80px; }
  .mp-footer { left: 0; }
  .profile-info-section { flex-direction: column; align-items: center; text-align: center; }
  .profile-details { padding-top: 20px; }
  .profile-actions { padding-top: 20px; }
  .profile-bio { max-width: 100%; }
}
</style>
@endsection

@section('content')
<div class="mp-page">
  <header class="mp-header">
    <div class="mp-logo">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
      Marketplace
    </div>
    <div class="mp-search">
      <svg class="mp-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"/></svg>
      <input type="search" placeholder="Search marketplace...">
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
      <button class="mp-action-btn accent" title="Create Post">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      </button>
      <img src="https://ui-avatars.com/api/?name=Rahul+Kumar&background=950101&color=fff" alt="User" class="mp-avatar">
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
      <a href="/marketplace/work-board" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg><span class="mp-nav-label">Work Board</span></a>
      <a href="/marketplace/digital-goods" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg><span class="mp-nav-label">Digital Goods</span></a>
      <div class="mp-nav-divider"></div>
      <a href="/marketplace/profile" class="mp-nav-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span class="mp-nav-label">Profile</span></a>
      <a href="/marketplace/settings" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg><span class="mp-nav-label">Settings</span></a>
    </nav>
  </aside>

  <main class="mp-main" id="mpMain">
    <div class="profile-banner"></div>

    <div class="profile-info-section">
      <div class="profile-avatar-wrap">
        <img src="https://ui-avatars.com/api/?name=Rahul+Kumar&background=950101&color=fff&size=160" alt="Rahul Kumar" class="profile-avatar-large">
      </div>
      <div class="profile-details">
        <h1 class="profile-name">Rahul Kumar</h1>
        <div class="profile-username">@rahul_kumar • Member since Jan 2024</div>
        <p class="profile-bio">Full-stack developer and designer. Love building cool stuff and helping fellow students. Open to freelance work and collaborations.</p>
        <div class="profile-meta">
          <div class="profile-meta-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Shoolini University
          </div>
          <div class="profile-meta-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            B.Tech CSE
          </div>
          <div class="profile-meta-item">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Verified Seller
          </div>
        </div>
      </div>
      <div class="profile-actions">
        <button class="profile-btn primary">Edit Profile</button>
        <button class="profile-btn secondary">Share Profile</button>
      </div>
    </div>

    <div class="profile-stats">
      <div class="stat-card">
        <div class="stat-label">Total Listings</div>
        <div class="stat-value">24</div>
        <div class="stat-change">+3 this month</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Items Sold</div>
        <div class="stat-value">18</div>
        <div class="stat-change">+5 this month</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Rating</div>
        <div class="stat-value">4.8</div>
        <div class="stat-change">From 42 reviews</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Revenue</div>
        <div class="stat-value">₹12.5k</div>
        <div class="stat-change">+₹3.2k this month</div>
      </div>
    </div>

    <div class="profile-tabs">
      <button class="profile-tab active" data-tab="listings">My Listings<span class="tab-count">24</span></button>
      <button class="profile-tab" data-tab="wishlist">Wishlist<span class="tab-count">12</span></button>
      <button class="profile-tab" data-tab="activity">Activity<span class="tab-count">48</span></button>
      <button class="profile-tab" data-tab="reviews">Reviews<span class="tab-count">42</span></button>
    </div>

    <div class="profile-content active" id="listings">
      <div class="listings-grid">
        @foreach([
          ['title'=>'iPhone 13 Pro', 'category'=>'Electronics', 'price'=>'45,000', 'image'=>'https://images.unsplash.com/photo-1632661674596-df8be070a5c5?w=300&h=200&fit=crop', 'status'=>'active'],
          ['title'=>'MacBook Air M1', 'category'=>'Laptops', 'price'=>'65,000', 'image'=>'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&h=200&fit=crop', 'status'=>'active'],
          ['title'=>'Sony WH-1000XM4', 'category'=>'Audio', 'price'=>'18,000', 'image'=>'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcf?w=300&h=200&fit=crop', 'status'=>'sold'],
          ['title'=>'iPad Air', 'category'=>'Tablets', 'price'=>'38,000', 'image'=>'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=300&h=200&fit=crop', 'status'=>'active'],
          ['title'=>'Canon EOS R5', 'category'=>'Cameras', 'price'=>'2,50,000', 'image'=>'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300&h=200&fit=crop', 'status'=>'active'],
          ['title'=>'AirPods Pro', 'category'=>'Audio', 'price'=>'15,000', 'image'=>'https://images.unsplash.com/photo-1606841837239-c5a1a4a07af7?w=300&h=200&fit=crop', 'status'=>'sold']
        ] as $listing)
        <div class="listing-card">
          <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="listing-image">
          <div class="listing-body">
            <div class="listing-category">{{ $listing['category'] }}</div>
            <h3 class="listing-title">{{ $listing['title'] }}</h3>
            <div class="listing-price">₹{{ $listing['price'] }}</div>
            <span class="listing-status {{ $listing['status'] }}">{{ $listing['status'] === 'active' ? 'Active' : 'Sold' }}</span>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="profile-content" id="wishlist">
      <div class="listings-grid">
        @foreach([
          ['title'=>'Gaming PC Setup', 'category'=>'Electronics', 'price'=>'85,000', 'image'=>'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=300&h=200&fit=crop', 'status'=>'active'],
          ['title'=>'Electric Guitar', 'category'=>'Instruments', 'price'=>'25,000', 'image'=>'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=300&h=200&fit=crop', 'status'=>'active'],
          ['title'=>'PS5 Console', 'category'=>'Gaming', 'price'=>'42,000', 'image'=>'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=300&h=200&fit=crop', 'status'=>'active']
        ] as $item)
        <div class="listing-card">
          <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="listing-image">
          <div class="listing-body">
            <div class="listing-category">{{ $item['category'] }}</div>
            <h3 class="listing-title">{{ $item['title'] }}</h3>
            <div class="listing-price">₹{{ $item['price'] }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="profile-content" id="activity">
      <div class="activity-list">
        @foreach([
          ['type'=>'sale', 'title'=>'Sold MacBook Air M1', 'desc'=>'Transaction completed successfully', 'time'=>'2 hours ago'],
          ['type'=>'listing', 'title'=>'Posted new listing: iPhone 13 Pro', 'desc'=>'Your listing is now live', 'time'=>'5 hours ago'],
          ['type'=>'review', 'title'=>'Received 5-star review', 'desc'=>'From @priya_sharma for Canon EOS R5', 'time'=>'1 day ago'],
          ['type'=>'message', 'title'=>'New message from @amit_singh', 'desc'=>'Interested in your iPad Air', 'time'=>'1 day ago'],
          ['type'=>'sale', 'title'=>'Sold AirPods Pro', 'desc'=>'Payment received', 'time'=>'2 days ago']
        ] as $activity)
        <div class="activity-item">
          <div class="activity-icon">
            @if($activity['type'] === 'sale')
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            @elseif($activity['type'] === 'listing')
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            @elseif($activity['type'] === 'review')
            <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @else
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            @endif
          </div>
          <div class="activity-content">
            <div class="activity-title">{{ $activity['title'] }}</div>
            <div class="activity-desc">{{ $activity['desc'] }}</div>
            <div class="activity-time">{{ $activity['time'] }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="profile-content" id="reviews">
      <div class="reviews-list">
        @foreach([
          ['name'=>'Priya Sharma', 'rating'=>5, 'date'=>'2 days ago', 'text'=>'Great seller! Product was exactly as described. Fast delivery and excellent communication. Highly recommend!'],
          ['name'=>'Amit Singh', 'rating'=>5, 'date'=>'5 days ago', 'text'=>'Amazing experience. The camera was in perfect condition. Rahul is very professional and responsive.'],
          ['name'=>'Neha Patel', 'rating'=>4, 'date'=>'1 week ago', 'text'=>'Good seller. Product quality was good but delivery took slightly longer than expected. Overall satisfied with the purchase.'],
          ['name'=>'Vikram Kumar', 'rating'=>5, 'date'=>'2 weeks ago', 'text'=>'Excellent! Very transparent about product condition. Fair pricing and quick transaction. Will buy again!']
        ] as $review)
        <div class="review-card">
          <div class="review-header">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($review['name']) }}&background=random&size=48" alt="{{ $review['name'] }}" class="review-avatar">
            <div class="review-info">
              <div class="review-name">{{ $review['name'] }}</div>
              <div class="review-rating">
                @for($i = 0; $i < $review['rating']; $i++)
                <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
              </div>
            </div>
            <div class="review-date">{{ $review['date'] }}</div>
          </div>
          <p class="review-text">{{ $review['text'] }}</p>
        </div>
        @endforeach
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

  // Tab switching
  document.querySelectorAll('.profile-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      const tabName = tab.dataset.tab;

      // Update active tab
      document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      // Show content
      document.querySelectorAll('.profile-content').forEach(c => c.classList.remove('active'));
      document.getElementById(tabName).classList.add('active');
    });
  });
})();
</script>
@endsection
