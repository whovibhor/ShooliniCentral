@extends('layouts.app')

@section('title', 'Digital Goods')
@section('hide_header', true)

@section('head')
<style>
/* Digital Goods Page - Gallery Grid Design */
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

/* Digital Goods Specific - Gallery Grid */
.digital-header { padding: 16px 0; margin-bottom: 20px; }
.digital-title { font-size: 28px; font-weight: 700; color: #ffffff; margin-bottom: 8px; }
.digital-subtitle { font-size: 14px; color: #888888; }

.digital-categories { display: flex; gap: 10px; margin-bottom: 32px; overflow-x: auto; padding-bottom: 8px; }
.digital-categories::-webkit-scrollbar { height: 4px; }
.digital-categories::-webkit-scrollbar-thumb { background: #3D0000; border-radius: 2px; }
.category-card { min-width: 140px; padding: 16px; background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; text-align: center; cursor: pointer; transition: all 200ms ease; }
.category-card:hover { border-color: #950101; transform: translateY(-4px); }
.category-card.active { background: #950101; border-color: #950101; }
.category-icon { width: 48px; height: 48px; margin: 0 auto 12px; background: #1a1a1a; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
.category-card.active .category-icon { background: rgba(255,255,255,0.1); }
.category-icon svg { width: 24px; height: 24px; color: #888888; }
.category-card.active .category-icon svg { color: #ffffff; }
.category-name { font-size: 13px; font-weight: 600; color: #cccccc; }
.category-card.active .category-name { color: #ffffff; }
.category-count { font-size: 11px; color: #888888; margin-top: 4px; }
.category-card.active .category-count { color: rgba(255,255,255,0.7); }

.digital-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-bottom: 48px; }

.digital-item { background: #0d0d0d; border: 1px solid #3D0000; border-radius: 12px; overflow: hidden; transition: all 300ms ease; cursor: pointer; position: relative; }
.digital-item:hover { border-color: #950101; transform: translateY(-8px); box-shadow: 0 16px 32px rgba(149,1,1,0.25); }

.digital-preview { width: 100%; height: 200px; background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
.digital-preview-icon { width: 64px; height: 64px; color: #3D0000; }
.digital-badge { position: absolute; top: 12px; left: 12px; padding: 6px 12px; background: rgba(0,0,0,0.9); backdrop-filter: blur(8px); border: 1px solid #3D0000; border-radius: 6px; font-size: 11px; font-weight: 600; text-transform: uppercase; color: #ffffff; }
.digital-badge.free { background: rgba(0,200,83,0.9); border-color: #00C853; }
.digital-downloads { position: absolute; top: 12px; right: 12px; padding: 6px 10px; background: rgba(0,0,0,0.9); backdrop-filter: blur(8px); border: 1px solid #3D0000; border-radius: 6px; font-size: 11px; font-weight: 600; color: #888888; display: flex; align-items: center; gap: 4px; }
.digital-downloads svg { width: 12px; height: 12px; }

.digital-content { padding: 16px; }
.digital-type { font-size: 11px; color: #888888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
.digital-name { font-size: 16px; font-weight: 600; color: #ffffff; margin-bottom: 8px; line-height: 1.3; }
.digital-desc { font-size: 13px; color: #cccccc; line-height: 1.5; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

.digital-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid #3D0000; }
.digital-author { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #888888; }
.digital-author img { width: 24px; height: 24px; border-radius: 50%; border: 1px solid #3D0000; }
.digital-price { font-size: 18px; font-weight: 700; color: #ffffff; }
.digital-price.free { color: #00C853; font-size: 14px; }

@media (max-width: 768px) {
  .mp-main { margin-left: 0; padding: 16px; }
  .mp-footer { left: 0; }
  .digital-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
}
</style>
@endsection

@section('content')
<div class="mp-page">
  <header class="mp-header">
    <div class="mp-logo">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
      Digital Goods
    </div>
    <div class="mp-search">
      <svg class="mp-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"/></svg>
      <input type="search" placeholder="Search digital products...">
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
      <button class="mp-action-btn accent" title="Upload Product">
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
      <a href="/marketplace/work-board" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg><span class="mp-nav-label">Work Board</span></a>
      <a href="/marketplace/digital-goods" class="mp-nav-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg><span class="mp-nav-label">Digital Goods</span></a>
      <div class="mp-nav-divider"></div>
      <a href="/marketplace/profile" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span class="mp-nav-label">Profile</span></a>
      <a href="/marketplace/settings" class="mp-nav-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg><span class="mp-nav-label">Settings</span></a>
    </nav>
  </aside>

  <main class="mp-main" id="mpMain">
    <div class="digital-header">
      <h1 class="digital-title">Digital Products</h1>
      <p class="digital-subtitle">Buy and sell notes, templates, code, and more</p>
    </div>

    <div class="digital-categories">
      <div class="category-card active">
        <div class="category-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
        </div>
        <div class="category-name">All Products</div>
        <div class="category-count">124 items</div>
      </div>
      @foreach([
        ['name'=>'Study Notes', 'count'=>'45', 'icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['name'=>'Templates', 'count'=>'32', 'icon'=>'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z'],
        ['name'=>'Code Snippets', 'count'=>'28', 'icon'=>'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
        ['name'=>'Assignments', 'count'=>'19', 'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2']
      ] as $cat)
      <div class="category-card">
        <div class="category-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"/></svg>
        </div>
        <div class="category-name">{{ $cat['name'] }}</div>
        <div class="category-count">{{ $cat['count'] }} items</div>
      </div>
      @endforeach
    </div>

    <div class="digital-grid">
      @foreach([
        ['name'=>'Data Structures Complete Notes', 'type'=>'PDF Notes', 'desc'=>'Complete DSA notes with diagrams, examples and practice problems', 'author'=>'Rahul Kumar', 'price'=>'150', 'downloads'=>'234', 'free'=>false],
        ['name'=>'Resume Templates Pack', 'type'=>'Figma Template', 'desc'=>'5 professional resume templates for tech interviews', 'author'=>'Priya Sharma', 'price'=>'Free', 'downloads'=>'567', 'free'=>true],
        ['name'=>'React Components Library', 'type'=>'Code', 'desc'=>'Reusable React components with TypeScript and Tailwind', 'author'=>'Amit Singh', 'price'=>'300', 'downloads'=>'189', 'free'=>false],
        ['name'=>'Physics Lab Manual', 'type'=>'PDF Document', 'desc'=>'Complete lab manual with theory, observations and graphs', 'author'=>'Neha Patel', 'price'=>'100', 'downloads'=>'412', 'free'=>false],
        ['name'=>'UI Design System', 'type'=>'Figma File', 'desc'=>'Complete design system with components and guidelines', 'author'=>'Vikram M.', 'price'=>'250', 'downloads'=>'298', 'free'=>false],
        ['name'=>'Python Cheat Sheet', 'type'=>'PDF', 'desc'=>'Quick reference guide for Python programming', 'author'=>'Anjali R.', 'price'=>'Free', 'downloads'=>'892', 'free'=>true],
        ['name'=>'Chemistry Notes Sem 3', 'type'=>'PDF Notes', 'desc'=>'Organic chemistry notes with reactions and mechanisms', 'author'=>'Karan V.', 'price'=>'120', 'downloads'=>'345', 'free'=>false],
        ['name'=>'Portfolio Website Template', 'type'=>'HTML/CSS', 'desc'=>'Modern responsive portfolio template ready to deploy', 'author'=>'Simran B.', 'price'=>'200', 'downloads'=>'156', 'free'=>false],
        ['name'=>'Machine Learning Notes', 'type'=>'PDF Notes', 'desc'=>'ML algorithms explained with mathematical proofs', 'author'=>'Rohan S.', 'price'=>'180', 'downloads'=>'267', 'free'=>false]
      ] as $item)
      <div class="digital-item">
        <div class="digital-preview">
          <svg class="digital-preview-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          <span class="digital-badge {{ $item['free'] ? 'free' : '' }}">{{ $item['free'] ? 'Free' : 'Premium' }}</span>
          <div class="digital-downloads">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V8"/></svg>
            {{ $item['downloads'] }}
          </div>
        </div>
        <div class="digital-content">
          <div class="digital-type">{{ $item['type'] }}</div>
          <h3 class="digital-name">{{ $item['name'] }}</h3>
          <p class="digital-desc">{{ $item['desc'] }}</p>
          <div class="digital-footer">
            <div class="digital-author">
              <img src="https://ui-avatars.com/api/?name={{ urlencode($item['author']) }}&background=random&size=24" alt="{{ $item['author'] }}">
              {{ $item['author'] }}
            </div>
            <div class="digital-price {{ $item['free'] ? 'free' : '' }}">{{ $item['free'] ? 'Free' : '₹'.$item['price'] }}</div>
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

  document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('click', () => {
      document.querySelectorAll('.category-card').forEach(c => c.classList.remove('active'));
      card.classList.add('active');
    });
  });
})();
</script>
@endsection
