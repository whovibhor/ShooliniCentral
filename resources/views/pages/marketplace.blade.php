@extends('layouts.app')

@section('title', 'Shoolini Marketplace')
@section('hide_header', true)

@section('head')
<style>
/* Marketplace Page Styles */
* { margin: 0; padding: 0; box-sizing: border-box; }

.mp-page {
  background: #000000;
  color: #ffffff;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  min-height: 100vh;
  overflow-x: hidden;
}

/* Header */
.mp-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 70px;
  background: #000000;
  border-bottom: 1px solid #3D0000;
  display: flex;
  align-items: center;
  padding: 0 24px;
  gap: 24px;
  z-index: 1000;
}

.mp-logo {
  font-size: 20px;
  font-weight: 700;
  color: #ffffff;
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 12px;
}

.mp-logo svg {
  color: #FF0000;
}

.mp-logo svg { width: 32px; height: 32px; }

.mp-search {
  flex: 1;
  max-width: 500px;
  position: relative;
}

.mp-search input {
  width: 100%;
  height: 42px;
  background: #0d0d0d;
  border: 1px solid #3D0000;
  border-radius: 8px;
  padding: 0 16px 0 44px;
  color: #ffffff;
  font-size: 14px;
  transition: all 200ms ease;
}

.mp-search input:focus {
  outline: none;
  border-color: #950101;
  box-shadow: 0 0 0 3px rgba(149,1,1,0.15);
  transform: translateY(-1px);
}

.mp-search input::placeholder { color: #888888; }

.mp-search-icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #888888;
  width: 20px;
  height: 20px;
}

.mp-actions {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-left: auto;
}

.mp-action-btn {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 1px solid #3D0000;
  background: transparent;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 200ms ease;
  position: relative;
}

.mp-action-btn:hover {
  background: #1a1a1a;
  border-color: #950101;
}

.mp-action-btn.accent {
  background: #950101;
  border-color: #950101;
}

.mp-action-btn.accent:hover {
  background: #FF0000;
  transform: scale(1.05);
}

.mp-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  width: 18px;
  height: 18px;
  background: #FF0000;
  border-radius: 50%;
  font-size: 10px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #000000;
}

.mp-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid #950101;
  object-fit: cover;
  cursor: pointer;
}

/* Sidebar */
.mp-sidebar {
  position: fixed;
  left: 0;
  top: 70px;
  width: 80px;
  height: calc(100vh - 70px);
  background: #000000;
  border-right: 1px solid #3D0000;
  transition: width 300ms cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 999;
  overflow: hidden;
}

.mp-sidebar.expanded {
  width: 280px;
}

.mp-sidebar-toggle {
  position: absolute;
  top: 12px;
  left: 50%;
  transform: translateX(-50%);
  width: 32px;
  height: 32px;
  border: 1px solid #3D0000;
  border-radius: 6px;
  background: transparent;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 200ms ease, border-color 200ms ease, transform 200ms ease;
  z-index: 10;
}

.mp-sidebar-toggle:hover {
  background: #1a1a1a;
  border-color: #950101;
}

.mp-sidebar-toggle:active {
  transform: translateX(-50%) scale(0.95);
}

.mp-nav {
  padding: 56px 12px 12px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.mp-nav-item {
  height: 48px;
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 12px 16px;
  border-radius: 8px;
  color: #cccccc;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  transition: all 200ms ease;
  white-space: nowrap;
  position: relative;
  cursor: pointer;
}

.mp-nav-item:hover {
  background: #1a1a1a;
  color: #ffffff;
}

.mp-nav-item.active {
  background: #0d0d0d;
  color: #ffffff;
  border-left: 3px solid #950101;
}

.mp-nav-item svg {
  width: 24px;
  height: 24px;
  flex-shrink: 0;
}

.mp-nav-label {
  opacity: 0;
  transform: translateX(-10px);
  transition: all 300ms ease;
}

.mp-sidebar.expanded .mp-nav-label {
  opacity: 1;
  transform: translateX(0);
}

.mp-nav-divider {
  height: 1px;
  background: #3D0000;
  margin: 16px 0;
}

.mp-nav-tooltip {
  position: absolute;
  left: 80px;
  background: #1a1a1a;
  color: #ffffff;
  padding: 8px 12px;
  border-radius: 6px;
  font-size: 12px;
  white-space: nowrap;
  pointer-events: none;
  opacity: 0;
  transform: translateX(-10px);
  transition: all 200ms ease;
  z-index: 1000;
}

.mp-sidebar:not(.expanded) .mp-nav-item:hover .mp-nav-tooltip {
  opacity: 1;
  transform: translateX(0);
}

.mp-sidebar.expanded .mp-nav-tooltip {
  display: none;
}

/* Main Content */
.mp-main {
  margin-left: 80px;
  margin-top: 5px;
  padding: 16px 24px 24px;
  min-height: calc(100vh - 70px - 60px);
  transition: margin-left 300ms cubic-bezier(0.4, 0, 0.2, 1);
}

.mp-sidebar.expanded ~ .mp-main {
  margin-left: 280px;
}

/* Hero Section */
.mp-hero {
  padding: 16px 0;
  margin-bottom: 20px;
}

.mp-hero-title {
  font-size: 28px;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 16px;
}

.mp-stats {
  display: flex;
  gap: 32px;
  flex-wrap: wrap;
}

.mp-stat {
  display: flex;
  align-items: center;
  gap: 12px;
}

.mp-stat-icon {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  background: #0d0d0d;
  border: 1px solid #3D0000;
  transition: all 200ms ease;
}

.mp-stat:hover .mp-stat-icon {
  border-color: #950101;
  transform: translateY(-2px);
}

.mp-stat-value {
  font-size: 20px;
  font-weight: 600;
  color: #ffffff;
}

.mp-stat-label {
  font-size: 14px;
  color: #888888;
}

/* Filter Bar */
.mp-filter-bar {
  position: sticky;
  top: 0;
  background: #000000;
  padding: 20px 0;
  margin-bottom: 24px;
  border-bottom: 1px solid #3D0000;
  z-index: 100;
}

.mp-categories {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  padding-bottom: 16px;
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.mp-categories::-webkit-scrollbar {
  display: none;
}

.mp-category-tab {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  border-radius: 24px;
  border: 1px solid #3D0000;
  background: transparent;
  color: #cccccc;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 200ms ease;
  white-space: nowrap;
}

.mp-category-tab:hover {
  background: #1a1a1a;
  border-color: #950101;
}

.mp-category-tab.active {
  background: #950101;
  color: #ffffff;
  border-color: #950101;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(149,1,1,0.2);
}

.mp-category-tab svg {
  width: 16px;
  height: 16px;
}

.mp-controls {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  margin-top: 16px;
}

.mp-control-group {
  display: flex;
  align-items: center;
  gap: 8px;
}

.mp-control-label {
  font-size: 14px;
  color: #888888;
}

.mp-dropdown {
  height: 38px;
  padding: 0 16px;
  background: #0d0d0d;
  border: 1px solid #3D0000;
  border-radius: 6px;
  color: #ffffff;
  font-size: 14px;
  cursor: pointer;
  transition: all 200ms ease;
}

.mp-dropdown:hover {
  border-color: #950101;
  transform: translateY(-1px);
}

.mp-dropdown:focus {
  outline: none;
  border-color: #950101;
  box-shadow: 0 0 0 2px rgba(149,1,1,0.1);
}

.mp-view-toggle {
  display: flex;
  gap: 4px;
}

.mp-view-btn {
  width: 38px;
  height: 38px;
  border: 1px solid #3D0000;
  background: transparent;
  color: #cccccc;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 200ms ease;
}

.mp-view-btn:hover {
  background: #1a1a1a;
  border-color: #950101;
}

.mp-view-btn.active {
  background: #950101;
  color: #ffffff;
  border-color: #950101;
  transform: scale(1.05);
}

/* Items Grid */
.mp-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 24px;
  margin-bottom: 48px;
}

/* Item Card */
.mp-card {
  background: #0d0d0d;
  border: 1px solid #3D0000;
  border-radius: 12px;
  overflow: hidden;
  transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
}

.mp-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 24px rgba(255, 0, 0, 0.15);
  border-color: #950101;
}

.mp-card-image-wrap {
  position: relative;
  aspect-ratio: 16/9;
  background: #1a1a1a;
  overflow: hidden;
}

.mp-card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 300ms ease;
}

.mp-card:hover .mp-card-image {
  transform: scale(1.05);
}

.mp-card-badges {
  position: absolute;
  top: 12px;
  left: 12px;
  display: flex;
  gap: 8px;
}

.mp-badge-status {
  padding: 4px 10px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 600;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(4px);
}

.mp-badge-status.available { color: #00FF00; }
.mp-badge-status.rented { color: #FFA500; }
.mp-badge-status.sold { color: #FF0000; }

.mp-favorite-btn {
  position: absolute;
  top: 12px;
  right: 12px;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(4px);
  border: none;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 200ms ease;
}

.mp-favorite-btn:hover {
  background: rgba(0, 0, 0, 0.9);
  transform: scale(1.1);
}

.mp-favorite-btn.active {
  color: #FF0000;
}

.mp-card-content {
  padding: 16px;
}

.mp-card-category {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 8px;
  font-size: 12px;
  color: #888888;
}

.mp-card-category svg {
  width: 14px;
  height: 14px;
  color: #950101;
}

.mp-card-title {
  font-size: 18px;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 8px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.mp-card-price-row {
  display: flex;
  align-items: baseline;
  gap: 8px;
  margin-bottom: 12px;
}

.mp-card-price {
  font-size: 24px;
  font-weight: 700;
  color: #ffffff;
}

.mp-card-original-price {
  font-size: 16px;
  color: #888888;
  text-decoration: line-through;
}

.mp-card-rental-info {
  font-size: 14px;
  color: #cccccc;
}

.mp-card-info {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 8px;
  flex-wrap: wrap;
}

.mp-card-info-item {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 14px;
  color: #cccccc;
}

.mp-card-info-item svg {
  width: 16px;
  height: 16px;
}

.mp-card-info-item.rating svg {
  color: #FFA500;
}

.mp-card-info-item.location svg,
.mp-card-info-item.time svg {
  color: #888888;
}

.mp-card-description {
  font-size: 14px;
  color: #cccccc;
  line-height: 1.5;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  margin-bottom: 16px;
}

.mp-card-footer {
  padding: 16px;
  border-top: 1px solid #3D0000;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.mp-card-seller {
  display: flex;
  align-items: center;
  gap: 8px;
}

.mp-card-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 2px solid #950101;
  object-fit: cover;
}

.mp-card-seller-name {
  font-size: 14px;
  font-weight: 500;
  color: #ffffff;
}

.mp-card-actions {
  display: flex;
  gap: 8px;
}

.mp-card-btn {
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 200ms ease;
  display: flex;
  align-items: center;
  gap: 6px;
  background: transparent;
  border: none;
}

.mp-card-btn.secondary {
  background: transparent;
  border: 1px solid #3D0000;
  color: #ffffff;
  position: relative;
  overflow: hidden;
}

.mp-card-btn.secondary::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);
  transition: left 0.5s ease;
}

.mp-card-btn.secondary:hover::after {
  left: 100%;
}

.mp-card-btn.secondary:hover {
  background: #1a1a1a;
  border-color: #950101;
  transform: translateX(2px);
}

.mp-card-btn.primary {
  background: transparent;
  border: none;
  color: #950101;
  position: relative;
  overflow: hidden;
  padding: 8px 0;
}

.mp-card-btn.primary::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: #FF0000;
  transition: width 0.3s ease;
}

.mp-card-btn.primary:hover::after {
  width: 100%;
}

.mp-card-btn.primary:hover {
  color: #FF0000;
  transform: translateX(4px);
}

/* Floating Action Button */
.mp-fab {
  position: fixed;
  bottom: 32px;
  right: 32px;
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background: #950101;
  color: #ffffff;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 20px rgba(149, 1, 1, 0.3);
  cursor: pointer;
  transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 999;
}

.mp-fab::before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: #FF0000;
  opacity: 0;
  transition: opacity 300ms ease;
}

.mp-fab svg {
  position: relative;
  z-index: 1;
}

.mp-fab:hover {
  transform: scale(1.1) rotate(90deg);
  box-shadow: 0 12px 28px rgba(149, 1, 1, 0.5);
}

.mp-fab:hover::before {
  opacity: 1;
}

.mp-fab:active {
  transform: scale(1.05) rotate(90deg);
}

.mp-fab svg {
  width: 28px;
  height: 28px;
}

/* Footer */
.mp-footer {
  position: fixed;
  bottom: 0;
  left: 80px;
  right: 0;
  height: 60px;
  background: #000000;
  border-top: 1px solid #3D0000;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
  transition: left 300ms cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 100;
}

.mp-sidebar.expanded ~ .mp-footer {
  left: 280px;
}

.mp-footer-links {
  display: flex;
  gap: 24px;
}

.mp-footer-link {
  color: #cccccc;
  text-decoration: none;
  font-size: 14px;
  transition: color 200ms ease;
}

.mp-footer-link:hover {
  color: #ffffff;
}

.mp-footer-link.danger {
  color: #FF0000;
}

.mp-footer-link.danger:hover {
  color: #FF0000;
  text-decoration: underline;
}

.mp-footer-copyright {
  color: #888888;
  font-size: 13px;
}

/* Responsive */
@media (max-width: 768px) {
  .mp-header {
    padding: 0 16px;
  }

  .mp-logo {
    font-size: 16px;
  }

  .mp-search {
    max-width: none;
  }

  .mp-main {
    margin-left: 0;
    padding: 16px;
  }

  .mp-sidebar {
    left: -280px;
  }

  .mp-sidebar.expanded {
    left: 0;
  }

  .mp-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .mp-footer {
    left: 0;
  }

  .mp-sidebar.expanded ~ .mp-footer {
    left: 0;
  }

  .mp-fab {
    bottom: 92px;
  }
}

@media (min-width: 769px) and (max-width: 1024px) {
  .mp-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
}
</style>
@endsection

@section('content')
<div class="mp-page">
  <!-- Header -->
  <header class="mp-header">
    <div class="mp-logo">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
      Shoolini Marketplace
    </div>

    <div class="mp-search">
      <svg class="mp-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35"/></svg>
      <input type="search" placeholder="Search for items, services, or skills...">
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

      <button class="mp-action-btn accent" title="New Listing">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      </button>

      <img src="https://ui-avatars.com/api/?name=Student&background=950101&color=fff" alt="User" class="mp-avatar">
    </div>
  </header>

  <!-- Sidebar -->
  <aside class="mp-sidebar" id="mpSidebar">
    <button class="mp-sidebar-toggle" id="sidebarToggle">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

    <nav class="mp-nav">
      <a href="/dashboard" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        <span class="mp-nav-label">Dashboard</span>
        <span class="mp-nav-tooltip">Dashboard</span>
      </a>

      <a href="/marketplace" class="mp-nav-item active">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        <span class="mp-nav-label">Marketplace</span>
        <span class="mp-nav-tooltip">Marketplace</span>
      </a>

      <a href="/marketplace/services" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        <span class="mp-nav-label">Services</span>
        <span class="mp-nav-tooltip">Services</span>
      </a>

      <a href="/marketplace/rentals" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <span class="mp-nav-label">My Rentals</span>
        <span class="mp-nav-tooltip">My Rentals</span>
      </a>

      <a href="/marketplace/skill-exchange" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
        <span class="mp-nav-label">Skill Exchange</span>
        <span class="mp-nav-tooltip">Skill Exchange</span>
      </a>

      <a href="/marketplace/tutoring" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        <span class="mp-nav-label">Tutoring</span>
        <span class="mp-nav-tooltip">Tutoring</span>
      </a>

      <a href="/marketplace/work-board" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        <span class="mp-nav-label">Work Board</span>
        <span class="mp-nav-tooltip">Work Board</span>
      </a>

      <a href="/marketplace/digital-goods" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
        <span class="mp-nav-label">Digital Goods</span>
        <span class="mp-nav-tooltip">Digital Goods</span>
      </a>

      <div class="mp-nav-divider"></div>

      <a href="/marketplace/profile" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span class="mp-nav-label">Profile</span>
        <span class="mp-nav-tooltip">Profile</span>
      </a>

      <a href="/marketplace/settings" class="mp-nav-item">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
        <span class="mp-nav-label">Settings</span>
        <span class="mp-nav-tooltip">Settings</span>
      </a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="mp-main" id="mpMain">
    <!-- Hero Section -->
    <section class="mp-hero">
      <h1 class="mp-hero-title">Welcome to Marketplace</h1>
      <div class="mp-stats">
        <div class="mp-stat">
          <div class="mp-stat-icon">
            <svg fill="none" stroke="#888888" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
          </div>
          <div>
            <div class="mp-stat-value">1,234</div>
            <div class="mp-stat-label">Active Listings</div>
          </div>
        </div>

        <div class="mp-stat">
          <div class="mp-stat-icon">
            <svg fill="none" stroke="#888888" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div>
            <div class="mp-stat-value">567</div>
            <div class="mp-stat-label">Services</div>
          </div>
        </div>

        <div class="mp-stat">
          <div class="mp-stat-icon">
            <svg fill="none" stroke="#888888" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
          </div>
          <div>
            <div class="mp-stat-value">89</div>
            <div class="mp-stat-label">Rentals Available</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Filter Bar -->
    <section class="mp-filter-bar">
      <div class="mp-categories">
        <button class="mp-category-tab active">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
          All Items
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
          Books
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
          Electronics
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
          Clothing
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="m13 2-2 2.5L9 2"/><path d="m3 7 3.17-2.475a1.996 1.996 0 0 1 2.415.004L12 7"/><path d="m21 7-3.17-2.475a1.996 1.996 0 0 0-2.415.004L12 7"/><rect width="18" height="14" x="3" y="7" rx="1"/></svg>
          Sports
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="m12 8-9.04 9.06a2.82 2.82 0 1 0 3.98 3.98L16 12"/><circle cx="17" cy="7" r="5"/></svg>
          Instruments
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          Furniture
        </button>
        <button class="mp-category-tab">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
          Others
        </button>
      </div>

      <div class="mp-controls">
        <div class="mp-control-group">
          <span class="mp-control-label">Sort by:</span>
          <select class="mp-dropdown">
            <option>Recent First</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
            <option>Most Popular</option>
            <option>Nearest First</option>
          </select>
        </div>

        <div class="mp-control-group">
          <span class="mp-control-label">Type:</span>
          <select class="mp-dropdown" style="width:140px">
            <option>All</option>
            <option>For Sale</option>
            <option>For Rent</option>
            <option>Both</option>
          </select>
        </div>

        <div class="mp-view-toggle">
          <button class="mp-view-btn active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
          </button>
          <button class="mp-view-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- Items Grid -->
    <div class="mp-grid">
      @foreach([
        ['title'=>'Introduction to Algorithms (CLRS)', 'price'=>'350', 'originalPrice'=>'500', 'category'=>'Books', 'seller'=>'Rahul K.', 'rating'=>'4.8', 'reviews'=>'23', 'location'=>'Block A, 204', 'time'=>'2 days ago', 'desc'=>'Slightly used, all pages intact. Perfect for CSE students.', 'status'=>'available', 'img'=>'book1'],
        ['title'=>'iPhone 12 - 128GB', 'price'=>'25,000', 'originalPrice'=>'35,000', 'category'=>'Electronics', 'seller'=>'Priya M.', 'rating'=>'4.9', 'reviews'=>'45', 'location'=>'Block B, 312', 'time'=>'5 hours ago', 'desc'=>'Excellent condition, battery health 92%. All accessories included.', 'status'=>'available', 'img'=>'phone1'],
        ['title'=>'Study Table with Chair', 'price'=>'150', 'rentalInfo'=>'/day', 'category'=>'Furniture', 'seller'=>'Amit S.', 'rating'=>'4.5', 'reviews'=>'12', 'location'=>'Block C, 105', 'time'=>'1 day ago', 'desc'=>'Perfect for studying. Good condition, sturdy build.', 'status'=>'rented', 'img'=>'furniture1'],
        ['title'=>'Gaming Laptop - RTX 3060', 'price'=>'60,000', 'originalPrice'=>'75,000', 'category'=>'Electronics', 'seller'=>'Vikram R.', 'rating'=>'4.9', 'reviews'=>'38', 'location'=>'Block A, 401', 'time'=>'3 days ago', 'desc'=>'High-performance gaming laptop. Perfect for coding and gaming.', 'status'=>'available', 'img'=>'laptop1'],
        ['title'=>'Guitar - Yamaha F280', 'price'=>'8,500', 'originalPrice'=>'12,000', 'category'=>'Instruments', 'seller'=>'Neha D.', 'rating'=>'4.7', 'reviews'=>'19', 'location'=>'Block D, 208', 'time'=>'1 week ago', 'desc'=>'Well-maintained acoustic guitar. Includes carrying case.', 'status'=>'available', 'img'=>'guitar1'],
        ['title'=>'Basketball', 'price'=>'80', 'rentalInfo'=>'/day', 'category'=>'Sports', 'seller'=>'Karan T.', 'rating'=>'4.6', 'reviews'=>'8', 'location'=>'Sports Complex', 'time'=>'4 hours ago', 'desc'=>'Official size basketball, great grip. Available for rent.', 'status'=>'available', 'img'=>'sports1']
      ] as $item)
      <div class="mp-card">
        <div class="mp-card-image-wrap">
          <img src="https://picsum.photos/seed/{{ $item['img'] }}/640/360" alt="{{ $item['title'] }}" class="mp-card-image">
          <div class="mp-card-badges">
            <span class="mp-badge-status {{ $item['status'] }}">{{ ucfirst($item['status']) }}</span>
          </div>
          <button class="mp-favorite-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          </button>
        </div>

        <div class="mp-card-content">
          <div class="mp-card-category">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            {{ $item['category'] }}
          </div>

          <h3 class="mp-card-title">{{ $item['title'] }}</h3>

          <div class="mp-card-price-row">
            <span class="mp-card-price">₹{{ $item['price'] }}</span>
            @if(isset($item['originalPrice']))
              <span class="mp-card-original-price">₹{{ $item['originalPrice'] }}</span>
            @endif
            @if(isset($item['rentalInfo']))
              <span class="mp-card-rental-info">{{ $item['rentalInfo'] }}</span>
            @endif
          </div>

          <div class="mp-card-info">
            <div class="mp-card-info-item rating">
              <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
              {{ $item['rating'] }} <span style="color:#888">({{ $item['reviews'] }})</span>
            </div>
            <div class="mp-card-info-item location">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              {{ $item['location'] }}
            </div>
            <div class="mp-card-info-item time">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              {{ $item['time'] }}
            </div>
          </div>

          <p class="mp-card-description">{{ $item['desc'] }}</p>
        </div>

        <div class="mp-card-footer">
          <div class="mp-card-seller">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($item['seller']) }}&background=950101&color=fff" alt="{{ $item['seller'] }}" class="mp-card-avatar">
            <span class="mp-card-seller-name">{{ $item['seller'] }}</span>
          </div>
          <div class="mp-card-actions">
            <button class="mp-card-btn primary">View Details →</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </main>

  <!-- Floating Action Button -->
  <button class="mp-fab" title="Create New Listing">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
  </button>

  <!-- Footer -->
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
  const main = document.getElementById('mpMain');
  const footer = document.getElementById('mpFooter');

  // Sidebar toggle
  toggle.addEventListener('click', () => {
    sidebar.classList.toggle('expanded');
    localStorage.setItem('sidebarExpanded', sidebar.classList.contains('expanded'));
  });

  // Restore sidebar state
  if (localStorage.getItem('sidebarExpanded') === 'true') {
    sidebar.classList.add('expanded');
  }

  // Category tabs
  document.querySelectorAll('.mp-category-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.mp-category-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
    });
  });

  // Favorite buttons
  document.querySelectorAll('.mp-favorite-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      btn.classList.toggle('active');
    });
  });

  // View toggle
  document.querySelectorAll('.mp-view-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.mp-view-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });
})();
</script>
@endsection

@section('title', 'Marketplace • NEST Shoolini')

@section('hide_header', true)

@section('head')
<style>
/* Marketplace Design Tokens (scoped) */
.mp-main{--mp-bg-primary:#0a0a0a;--mp-bg-secondary:#121212;--mp-bg-card:#1c1c1c;--mp-bg-card-hover:#1f1f1f;--mp-fg-primary:#fafafa;--mp-fg-secondary:#a3a3a3;--mp-fg-muted:#666;--mp-accent:#dc2626;--mp-accent-hover:#ef4444;--mp-accent-light:#fee2e2;--mp-border:#2e2e2e;--mp-border-hover:#dc2626;--mp-shadow-card:0 4px 6px rgba(0,0,0,.3);--mp-shadow-card-hover:0 20px 25px rgba(0,0,0,.4),0 0 20px rgba(220,38,38,.2);--mp-shadow-glow:0 0 20px rgba(220,38,38,.3);--mp-shadow-glow-hover:0 0 30px rgba(220,38,38,.5);--mp-radius-sm:.25rem;--mp-radius-md:.5rem;--mp-radius-lg:.75rem;--mp-radius-xl:1rem;--mp-radius-full:9999px;--mp-t-fast:150ms cubic-bezier(.4,0,.2,1);--mp-t-base:200ms cubic-bezier(.4,0,.2,1);--mp-t-slow:300ms cubic-bezier(.4,0,.2,1);--mp-t-slowest:500ms cubic-bezier(.4,0,.2,1)}
.mp-page{background:#f9fafb;min-height:100vh}
.mp-shell{display:flex;--sb-collapsed:64px;--sb-expanded:256px;--sb:var(--sb-collapsed);min-height:100vh}
.mp-shell.expanded{--sb:var(--sb-expanded)}
.mp-sidebar{position:sticky;top:0;height:100vh;width:var(--sb);border-right:1px solid #e5e7eb;background:#ffffff;overflow:hidden;transition:width 300ms ease-in-out}
.mp-main{min-width:0;flex:1;background:var(--mp-bg-primary);color:var(--mp-fg-primary);} /* keep main panel content as-is */

/* Sidebar */
.sb-wrap{display:flex;flex-direction:column;height:100%}
.sb-top{display:flex;align-items:center;gap:8px;height:56px;border-bottom:1px solid #e5e7eb;padding:0 8px}
.sb-title{font-size:.95rem;font-weight:600;color:#111827;display:none}
.sb-toggle{width:36px;height:36px;border:1px solid #e5e7eb;border-radius:10px;background:#ffffff;color:#111827;display:flex;align-items:center;justify-content:center;transition:all 200ms}
.sb-toggle:hover{background:#f3f4f6}
.sb-items{padding:8px;display:flex;flex-direction:column;gap:6px;overflow:hidden}
.sb-item{display:flex;align-items:center;gap:12px;padding:10px;border-radius:12px;color:#374151;text-decoration:none;transition:all 200ms}
.sb-item .sb-icon{width:20px;height:20px;display:inline-flex;align-items:center;justify-content:center;transition:transform 200ms}
.sb-item .sb-label{display:none;font-size:.9rem;font-weight:500}
.sb-item:hover{background:#f3f4f6;color:#111827}
.sb-item:hover .sb-icon{transform:scale(1.1)}
.sb-item.active{background:#eef2ff;color:#111827}
.sb-footer{margin-top:auto;padding:8px;border-top:1px solid #e5e7eb}
.mp-shell.expanded .sb-label{display:inline}
.mp-shell.expanded .sb-title{display:inline}
.mp-shell.expanded .sb-items{padding:10px}

/* Main panel */
.mp-header{display:flex;flex-wrap:wrap;gap:8px 12px;align-items:flex-end;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--mp-border);background:rgba(10,10,10,.8);backdrop-filter:blur(16px)}
.mp-head-left{display:flex;flex-direction:column;gap:6px}
.mp-title{font-size:1.875rem;font-weight:800;letter-spacing:-.02em;color:var(--mp-fg-primary)}
.mp-subtitle{font-size:.875rem;color:var(--mp-fg-secondary)}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border-radius:var(--mp-radius-md);border:1px solid transparent;background:var(--mp-accent);color:#fff;text-decoration:none;transition:var(--mp-t-base)}
.btn:hover{transform:scale(1.05);box-shadow:0 10px 15px rgba(220,38,38,.3)}
.btn:active{transform:scale(.95)}
.btn-outline{background:transparent;color:var(--mp-fg-primary);border:1px solid var(--mp-border)}
.btn-outline:hover{background:var(--mp-bg-card-hover);border-color:var(--mp-accent)}

/* Tabs removed (sidebar drives navigation) */

/* Content grid */
.mp-content{padding:18px 20px}
.cards{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px}
@media(max-width:1280px){.cards{grid-template-columns:repeat(3,minmax(0,1fr))}}
@media(max-width:900px){.cards{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:575.98px){.cards{grid-template-columns:1fr}}
.card{border:1px solid var(--mp-border);border-radius:var(--mp-radius-lg);background:var(--mp-bg-card);overflow:hidden;display:flex;flex-direction:column;box-shadow:var(--mp-shadow-card);transition:var(--mp-t-slow)}
.card:hover{transform:scale(1.01);box-shadow:var(--mp-shadow-card-hover);border-color:var(--mp-accent)}
.card-media{aspect-ratio:1/1;background:#0d0d0d;border-bottom:1px solid var(--mp-border);overflow:hidden}
.card-media img{width:100%;height:100%;object-fit:cover;display:block;transition:transform var(--mp-t-slowest)}
.card:hover .card-media img{transform:scale(1.05)}
.card-body{padding:12px;display:flex;flex-direction:column;gap:10px}
.card h3{margin:0;color:var(--mp-fg-primary);font-size:.98rem;font-weight:600;line-height:1.25;transition:color var(--mp-t-base)}
.card h3:hover{color:var(--mp-accent)}
.card p{margin:0;color:var(--mp-fg-secondary)}
.meta{display:flex;align-items:center;justify-content:space-between;color:var(--mp-fg-secondary);font-size:.75rem}
.badge{display:inline-block;padding:4px 10px;border-radius:.25rem;border:1px solid var(--mp-border);font-size:.75rem;color:var(--mp-fg-secondary);background:rgba(10,10,10,.8);backdrop-filter:blur(8px)}
.price{color:var(--mp-accent);font-weight:700;font-size:1.2rem}

/* Search bar, chips, stats */
.mp-searchbar{position:relative;max-width:560px}
.mp-searchbar input{width:100%;height:3rem;background:var(--mp-bg-card);border:1px solid var(--mp-border);border-radius:.5rem;padding:.75rem .75rem .75rem 2.75rem;color:var(--mp-fg-primary);font-size:.875rem;transition:border-color var(--mp-t-base), box-shadow var(--mp-t-base)}
.mp-searchbar input:focus{outline:none;border-color:var(--mp-accent);box-shadow:0 0 0 2px rgba(220,38,38,.2)}
.mp-searchbar .icon{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);color:var(--mp-fg-secondary);width:1.25rem;height:1.25rem}
.mp-toolbar{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
/* Toolbar button sizing and icon alignment */
.mp-toolbar .btn-outline,.mp-toolbar .btn{height:2.5rem;display:inline-flex;align-items:center;gap:8px;padding:0 12px;border-radius:.75rem;border:1px solid var(--mp-border);background:var(--mp-bg-card);color:var(--mp-fg-primary)}
.mp-toolbar .btn-outline:hover,.mp-toolbar .btn:hover{background:var(--mp-bg-card-hover);border-color:var(--mp-accent)}
.mp-toolbar .btn-outline svg,.mp-toolbar .btn svg{width:16px;height:16px;fill:none;stroke:currentColor;opacity:.85}
.chip{display:inline-flex;align-items:center;gap:8px;padding:.5rem 1rem;background:var(--mp-bg-card);border:1px solid var(--mp-border);border-radius:.75rem;font-size:.875rem;font-weight:500;color:var(--mp-fg-primary);cursor:pointer;transition:var(--mp-t-base);white-space:nowrap}
.chip:hover{border-color:var(--mp-accent);background:var(--mp-bg-card-hover)}
.chip .icon{width:1rem;height:1rem;color:var(--mp-fg-secondary)}
.mp-stats{display:grid;gap:12px;padding:18px 20px}
@media(min-width:768px){.mp-stats{grid-template-columns:repeat(2,1fr)}}
@media(min-width:1280px){.mp-stats{grid-template-columns:repeat(4,1fr)}}
.stat-card{background:var(--mp-bg-card);padding:1rem;border-radius:.75rem;border:1px solid var(--mp-border)}
.stat-card .value{font-size:1.5rem;font-weight:700;color:var(--mp-accent)}
.stat-card .label{font-size:.875rem;color:var(--mp-fg-secondary)}

/* Product card like button */
.like-btn{position:absolute;top:10px;right:10px;width:2.25rem;height:2.25rem;border-radius:9999px;display:flex;align-items:center;justify-content:center;background:rgba(10,10,10,.8);backdrop-filter:blur(8px);border:none;color:var(--mp-fg-primary);cursor:pointer;transition:var(--mp-t-base)}
.like-btn:hover{transform:scale(1.1);background:#0a0a0a}
.like-btn svg{width:20px;height:20px;stroke:currentColor;fill:none}
.like-btn.liked{color:var(--mp-accent)}
.like-btn.liked svg{fill:var(--mp-accent);stroke:var(--mp-accent)}

/* Panels */
[role="tabpanel"]{display:none}
[role="tabpanel"].is-active{display:block}

/* Footer spacing reacts to sidebar width */
.mk-footer{padding-left:var(--mp-sb,64px);transition:padding-left 300ms ease-in-out}
.mk-footer .footer-inner{background:#ffffff;border-top:1px solid #e5e7eb}

</style>
@endsection

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="mp-page">
<div class="mp-shell">
  <!-- Sidebar -->
  <aside id="mpSidebar" class="mp-sidebar" aria-label="Marketplace sections">
    <div class="sb-wrap">
      <div class="sb-top">
        <button id="sbToggle" class="sb-toggle" type="button" aria-expanded="false" title="Expand sidebar">
          <svg id="iconMenu" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
          <svg id="iconChevron" style="display:none" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15,18 9,12 15,6"/></svg>
        </button>
        <span class="sb-title">Marketplace</span>
      </div>
      <nav class="sb-items" role="tablist" aria-orientation="vertical">
        <!-- Explore at top -->
  <a href="#" class="sb-item" data-tab="tab-explore" role="tab" aria-selected="false" aria-controls="tab-explore" title="Explore">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5l-5 5l1.5-6.5z"/></svg></span><span class="sb-label">Explore</span>
        </a>
        <!-- Home link -->
        <a href="/home" class="sb-item" title="Home">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><path d="M3 11l9-7 9 7"/><path d="M9 22V12h6v10"/></svg></span><span class="sb-label">Home</span>
        </a>
        <!-- Marketplace remains active by default -->
  <a href="#" class="sb-item active" data-tab="tab-market" role="tab" aria-selected="true" aria-controls="tab-market" title="Marketplace">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><path d="M6 8h12l-1 10H7L6 8z"/><path d="M9 8a3 3 0 0 1 6 0"/></svg></span><span class="sb-label">Marketplace</span>
        </a>
  <a href="#" class="sb-item" data-tab="tab-services" role="tab" aria-selected="false" aria-controls="tab-services" title="Services">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="10" rx="2"/><path d="M8 7V5h8v2"/></svg></span><span class="sb-label">Services</span>
        </a>
  <a href="#" class="sb-item" data-tab="tab-rentals" role="tab" aria-selected="false" aria-controls="tab-rentals" title="Rentals">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><path d="M3 12a7 7 0 0 1 7-7h3"/><path d="M21 12a7 7 0 0 1-7 7h-3"/><polyline points="10,5 13,5 13,8"/><polyline points="14,19 11,19 11,16"/></svg></span><span class="sb-label">Rentals</span>
        </a>
  <a href="#" class="sb-item" data-tab="tab-exchange" role="tab" aria-selected="false" aria-controls="tab-exchange" title="Skill Exchange">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><path d="M3 12h7l-2 2 2 2H3z"/><path d="M21 12h-7l2-2-2-2h7z"/></svg></span><span class="sb-label">Skill Exchange</span>
        </a>
  <a href="#" class="sb-item" data-tab="tab-tutors" role="tab" aria-selected="false" aria-controls="tab-tutors" title="Tutors">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><path d="M3 4h13a3 3 0 0 1 3 3v13"/><path d="M3 4v16a2 2 0 0 0 2 2h14"/></svg></span><span class="sb-label">Tutors</span>
        </a>
  <a href="#" class="sb-item" data-tab="tab-profile" role="tab" aria-selected="false" aria-controls="tab-profile" title="Profile">
          <span class="sb-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5 21a7 7 0 0 1 14 0"/></svg></span><span class="sb-label">Profile</span>
        </a>
      </nav>
      <!-- Admin link removed from sidebar as requested -->
    </div>
  </aside>

  <!-- Main Panel -->
  <main class="mp-main">

    <section id="tab-market" class="mp-content" role="tabpanel" aria-labelledby="market-tab" aria-live="polite">
      <!-- Search + Filters Row -->
      <div class="mp-toolbar" style="padding:0 0 14px 0">
        <div class="mp-searchbar">
          <svg class="icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="search" placeholder="Search items, categories, sellers…" aria-label="Search marketplace">
        </div>
        <button class="btn-outline" type="button" aria-label="Choose category">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:.8"><rect x="3" y="4" width="7" height="7"/><rect x="14" y="4" width="7" height="7"/><rect x="3" y="15" width="7" height="7"/><rect x="14" y="15" width="7" height="7"/></svg>
          Categories
        </button>
        <button class="btn-outline" type="button" aria-label="Sort listings">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:.8"><path d="M3 6h14"/><path d="M3 12h10"/><path d="M3 18h6"/></svg>
          Sort
        </button>
        <button class="btn-outline" type="button" aria-label="Filter listings">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:.8"><path d="M3 5h18l-7 8v6l-4-2v-4z"/></svg>
          Filters
        </button>
      </div>

      <!-- Category Chips removed as requested -->

      <!-- Stats Grid -->
      <div class="mp-stats">
        <div class="stat-card"><div class="value">2,847</div><div class="label">Active Listings</div></div>
        <div class="stat-card"><div class="value">1,293</div><div class="label">Sellers</div></div>
        <div class="stat-card"><div class="value">8,412</div><div class="label">Transactions</div></div>
        <div class="stat-card"><div class="value">98.5%</div><div class="label">Success Rate</div></div>
      </div>

      <!-- Product Grid -->
      <div class="cards">
        @foreach([
          ['Premium Smart Watch Pro','₹ 299','TechDeals','watch1'],
          ['Wireless Noise-Cancelling Headphones','₹ 199','AudioWorld','head1'],
          ['Mechanical Gaming Keyboard RGB','₹ 149','GamersHub','kbd1'],
          ['Mirrorless Camera Body','₹ 599','CamZone','cam2'],
          ['Ergonomic Study Chair','₹ 120','HostelMart','chair1'],
          ['iPad 10th Gen (Wi‑Fi)','₹ 389','SmartHub','ipad1']
        ] as [$t,$p,$seller,$seed])
        @php $slug = Str::slug($t).'-'.$seed; @endphp
        <article class="card" style="position:relative">
          <button class="like-btn" type="button" aria-label="Like listing">
            <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/></svg>
          </button>
          <div class="card-media"><img src="https://picsum.photos/seed/{{ $seed }}/640/480" alt="{{ $t }}"></div>
          <div class="card-body">
            <h3>{{ $t }}</h3>
            <div class="meta"><span class="price">{{ $p }}</span><span style="display:flex;align-items:center;gap:8px;color:var(--mp-fg-secondary)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V22a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 5 15.4a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 8.6 4.6 1.65 1.65 0 0 0 9.6 3.09V3a2 2 0 1 1 4 0v.09A1.65 1.65 0 0 0 15.4 4.6a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 20.91 9H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg> {{ $seller }}</span></div>
            <div style="display:flex;gap:8px;margin-top:4px">
              <a href="{{ route('marketplace.product', ['slug'=>$slug]) }}" class="btn-outline">View</a>
              <a href="{{ route('marketplace.product', ['slug'=>$slug]) }}#buy" class="btn">Buy</a>
            </div>
          </div>
        </article>
        @endforeach
      </div>

      <!-- Load More -->
      <div style="display:flex;justify-content:center;padding:24px 0">
        <button class="btn-outline" type="button" aria-label="Load more listings">Load More</button>
      </div>
    </section>

    <section id="tab-services" class="mp-content" role="tabpanel" aria-live="polite">
      <div class="cards">
        @foreach([
          ['Poster Design','₹ 150 / poster','Fast 24h delivery'],
          ['Photography (Event)','₹ 600 / session','Includes edits'],
          ['Coding Help (DSA)','₹ 300 / hour','Live screen-share'],
          ['Video Editing','₹ 250 / reel','2 revisions']
        ] as [$t,$p,$d])
        <article class="card">
          <div class="card-body">
            <h3>{{ $t }}</h3>
            <p>{{ $d }}</p>
            <div class="meta"><span class="price">{{ $p }}</span>
              <span style="display:flex;gap:8px">
                <a class="btn-outline" href="{{ route('marketplace.product', ['slug'=> Str::slug($t).'-svc']) }}">View</a>
              </span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
    </section>

    <section id="tab-rentals" class="mp-content" role="tabpanel" aria-live="polite">
      <div class="cards">
        @foreach([
          ['Tripod','₹ 100 / day','Deposit ₹ 300','rent1'],
          ['Bluetooth Speaker','₹ 80 / day','Deposit ₹ 200','rent2'],
          ['Bike','₹ 250 / day','Deposit ₹ 1000','rent3'],
          ['Calculator FX-991EX','₹ 50 / day','No deposit','rent4']
        ] as [$t,$rate,$dep,$seed])
        <article class="card">
          <div class="card-media"><img src="https://picsum.photos/seed/{{ $seed }}/640/360" alt="{{ $t }}"></div>
          <div class="card-body">
            <h3>{{ $t }}</h3>
            <p>{{ $dep }}</p>
            <div class="meta"><span class="price">{{ $rate }}</span>
              <span style="display:flex;gap:8px">
                <a class="btn-outline" href="{{ route('marketplace.product', ['slug'=> Str::slug($t).'-rent']) }}">View</a>
              </span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
    </section>

    <section id="tab-exchange" class="mp-content" role="tabpanel" aria-live="polite">
      <div class="cards">
        @foreach([
          ['Teach Photoshop ↔ Learn Python','Fair swap','exchange1'],
          ['Video Editing tips ↔ DSA help','1:1 barter','exchange2'],
          ['Guitar basics ↔ Resume review','60 min each','exchange3']
        ] as [$t,$d,$seed])
        <article class="card">
          <div class="card-media"><img src="https://picsum.photos/seed/{{ $seed }}/640/360" alt="{{ $t }}"></div>
          <div class="card-body">
            <h3>{{ $t }}</h3>
            <p>{{ $d }}</p>
            <div class="meta"><span class="badge">Barter</span>
              <span style="display:flex;gap:8px">
                <a class="btn-outline" href="{{ route('marketplace.product', ['slug'=> Str::slug($t).'-swap']) }}">View</a>
              </span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
    </section>

    <section id="tab-tutors" class="mp-content" role="tabpanel" aria-live="polite">
      <div class="cards">
        @foreach([
          ['C++ Weekend Classes','₹ 400 / class','4.9★ (32 reviews)'],
          ['Maths – Calculus','₹ 350 / hour','4.8★ (20 reviews)'],
          ['DSA Crash Course','₹ 500 / 2h','4.7★ (18 reviews)']
        ] as [$t,$p,$r])
        <article class="card">
          <div class="card-body">
            <h3>{{ $t }}</h3>
            <p>{{ $r }}</p>
            <div class="meta"><span class="price">{{ $p }}</span>
              <span style="display:flex;gap:8px">
                <a class="btn-outline" href="{{ route('marketplace.product', ['slug'=> Str::slug($t).'-tutor']) }}">View</a>
              </span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
    </section>

    <section id="tab-explore" class="mp-content" role="tabpanel" aria-live="polite">
      <div class="cards">
        @foreach([
          ['Hot Rentals','Trending this week','exp1'],
          ['New Listings','Fresh items added','exp2'],
          ['Top Tutors','Best rated tutors','exp3']
        ] as [$t,$d,$seed])
        <article class="card">
          <div class="card-media"><img src="https://picsum.photos/seed/{{ $seed }}/640/360" alt="{{ $t }}"></div>
          <div class="card-body">
            <h3>{{ $t }}</h3>
            <p>{{ $d }}</p>
            <div class="meta"><span class="badge">Explore</span>
              <span style="display:flex;gap:8px">
                <a class="btn-outline" href="{{ route('marketplace.product', ['slug'=> Str::slug($t).'-explore']) }}">View</a>
              </span>
            </div>
          </div>
        </article>
        @endforeach
      </div>
    </section>

    <section id="tab-profile" class="mp-content" role="tabpanel" aria-live="polite">
      <div class="cards">
        <article class="card">
          <div class="card-body">
            <h3>Your Profile & Reputation</h3>
            <p>Reputation: 820 pts • Badges: Top Rated Renter, Skill Pro</p>
            <div class="meta"><span class="badge">Portfolio</span>
              <span style="display:flex;gap:8px">
                <a class="btn-outline" href="{{ route('marketplace.product', ['slug'=> 'profile-portfolio']) }}">View</a>
              </span>
            </div>
          </div>
        </article>
      </div>
    </section>

  </main>
</div>
</div>
@endsection

@section('scripts')
<script>
(function(){
  const shell = document.querySelector('.mp-shell');
  const toggle = document.getElementById('sbToggle');
  const tabLinks = Array.from(document.querySelectorAll('.sb-item[data-tab]'));
  const panels = Array.from(document.querySelectorAll('[role="tabpanel"]'));
  const likeButtons = () => Array.from(document.querySelectorAll('.like-btn'));

  const selectTab = (id) => {
    tabLinks.forEach(a => {
      const active = a.dataset.tab === id;
      a.classList.toggle('active', active);
      a.setAttribute('aria-selected', active ? 'true' : 'false');
    });
    panels.forEach(p => p.classList.toggle('is-active', p.id === id));
  };

  // init
  selectTab('tab-market');

  tabLinks.forEach(a => a.addEventListener('click', (e) => { e.preventDefault(); selectTab(a.dataset.tab); }));

  // init root var for footer spacing
  const setSbVar = (px) => document.documentElement.style.setProperty('--mp-sb', px);
  setSbVar('64px');

  toggle.addEventListener('click', () => {
    const expanded = shell.classList.toggle('expanded');
    toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    const menu = document.getElementById('iconMenu');
    const chev = document.getElementById('iconChevron');
    if (expanded){ menu.style.display='none'; chev.style.display='block'; setSbVar('256px'); }
    else { menu.style.display='block'; chev.style.display='none'; setSbVar('64px'); }
  });

  // like toggle
  const bindLikes = () => likeButtons().forEach(btn => btn.addEventListener('click', () => btn.classList.toggle('liked')));
  bindLikes();
})();
</script>
@endsection

@section('footer')
  <div class="mk-footer">
    <div class="footer-inner">
      @includeIf('partials.footer-section')
    </div>
  </div>
@endsection
