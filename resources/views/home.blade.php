@extends('layouts.app')

@section('title', 'NEST Shoolini - Your Ultimate Campus Hub')
@section('description', 'Connect, share, and discover everything happening at Shoolini University. From anonymous confessions to marketplace deals, events, and more.')

@section('head')
<style>
    /* Scoped reset and base for this section */
    .why2-section *, .why2-section *::before, .why2-section *::after { box-sizing: border-box; }
    .why2-section h1, .why2-section h2, .why2-section p { margin: 0; padding: 0; }
    .why2-section { background: #000000; min-height: 100vh; display: flex; align-items: center; font-family: system-ui, -apple-system, sans-serif; }
            .why2-container { width: 100%; max-width: 1024px; margin: 0 auto; padding: 10px 24px 128px; }
    @media (min-width: 768px) { .why2-container { padding-left: 48px; padding-right: 48px; } }

    /* Title Section */
                .why2-section .why2-title { text-align: center; color: #ffffff; font-weight: 700; letter-spacing: -0.025em; line-height: 1; margin-bottom: 96px; font-size: 60px; }
                @media (min-width: 768px) { .why2-section .why2-title { font-size: 72px; } }
                @media (min-width: 1024px) { .why2-section .why2-title { font-size: 96px; } }
    #why-nest-word { display: inline-block; cursor: default; animation: pulse-breathing 3s ease-in-out infinite; transition: color 500ms ease; }
    #why-nest-word:hover { color: #dc2626; }

    /* Benefits Grid */
    .why2-grid-wrap { background: #18181b; display: grid; grid-template-columns: 1fr; gap: 1px; margin-bottom: 128px; border-radius: 0; overflow: hidden; }
    @media (min-width: 768px) { .why2-grid-wrap { grid-template-columns: repeat(3, 1fr); } }
    .why2-card { background: #000000; padding: 32px; cursor: pointer; transition: background 300ms ease, color 300ms ease; }
    @media (min-width: 768px) { .why2-card { padding: 40px; } }
    .why2-icon { width: 32px; height: 32px; color: #3f3f46; margin-bottom: 24px; transition: color 300ms ease; }
    .why2-icon svg { width: 32px; height: 32px; display: block; }
    .why2-card-title { font-size: 18px; font-weight: 600; color: #a1a1aa; margin-bottom: 12px; transition: color 300ms ease; }
    .why2-card-desc { font-size: 14px; font-weight: 400; color: #71717a; line-height: 1.625; transition: color 300ms ease; }
    .why2-card:hover { background: #09090b; }
    .why2-card:hover .why2-icon { color: #dc2626; }
    .why2-card:hover .why2-card-title { color: #dc2626; }
    .why2-card:hover .why2-card-desc { color: #d4d4d8; }

    /* Developer Message */
    .why2-dev { position: relative; border-left: 1px solid #18181b; padding-left: 32px; }
    @media (min-width: 768px) { .why2-dev { padding-left: 48px; } }
    .why2-marker { position: absolute; top: 0; left: -9px; width: 16px; height: 16px; background: #dc2626; transform: rotate(45deg); }
    .why2-dev p { font-size: 16px; font-weight: 400; color: #a1a1aa; line-height: 1.625; }
    .why2-dev p + p { margin-top: 24px; }
    .why2-signature { margin-top: 32px; display: flex; align-items: center; gap: 12px; }
    .why2-signature-line { width: 48px; height: 1px; background: #27272a; }
    .why2-signature-text { font-size: 14px; color: #52525b; text-transform: uppercase; letter-spacing: 0.1em; }

    /* Animations: base state */
    .why2-card, .why2-dev, .why2-dev p, .why2-signature { opacity: 0; }
    .why2-card.animate-in { animation: fade-up 800ms ease-out forwards; }
    .why2-dev.animate-in { animation: fade-up 800ms ease-out forwards; }
    .why2-dev p.animate-in { animation: focus-in 1200ms ease-out forwards; }
    .why2-signature.animate-in { animation: fade-up 800ms ease-out forwards; }

    /* Keyframes */
    @keyframes pulse-breathing { 0%, 100% { opacity: 1; } 50% { opacity: 0.7; } }
    @keyframes fade-up { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes focus-in { from { opacity: 0; filter: blur(10px); } to { opacity: 1; filter: blur(0); } }
</style>
    <style>
        /* Testimonials Carousel (tc-*) */
        .tc-section { background:#000000; min-height:100vh; display:flex; align-items:center; }
        .tc-container { width:100%; max-width:1400px; margin:0 auto; padding:128px 24px; font-family: system-ui, -apple-system, sans-serif; }
        .tc-grid { display:grid; grid-template-columns:1fr; gap:80px; align-items:start; }
        @media (min-width:1024px){ .tc-grid{ grid-template-columns: 1fr 1fr; gap:120px; } }

        /* Left column: stacked cards */
        .tc-left { display:flex; justify-content:center; }
        @media (min-width:1024px){ .tc-left{ justify-content:flex-start; } }
            .tc-left-wrap { position:relative; width:100%; max-width:600px; height:500px; }
            @media (max-width:1023.98px){ .tc-left-wrap{ height:450px; } }
            .tc-deck { position:absolute; inset:0; pointer-events:none; }
            .tc-deck-card { position:absolute; top:0; left:0; width:100%; height:100%; background:#000000; border:1px solid #dc2626; border-radius:16px; opacity:0.25; }
            .tc-deck-card.d1 { transform: translate(-10px, -10px) scale(0.99); }
            .tc-deck-card.d2 { transform: translate(-20px, -20px) scale(0.98); opacity:0.2; }
            .tc-deck-card.d3 { transform: translate(-30px, -30px) scale(0.97); opacity:0.15; }
            .tc-deck-card.d4 { transform: translate(-40px, -40px) scale(0.96); opacity:0.1; }
            .tc-stack { position:absolute; inset:0; }
            .tc-card { position:absolute; top:0; left:0; width:100%; height:100%; background:#000000; border:1px solid #dc2626; border-radius:16px; padding:48px; display:flex; flex-direction:column; transition: all 600ms cubic-bezier(0.4,0,0.2,1); cursor:pointer; }
        @media (max-width:1023.98px){ .tc-card{ padding:32px; } }
            .tc-card:hover { border-color:#dc2626; transform: translateY(-2px); transition: all 300ms ease; }

        /* Card content */
        .tc-company { display:flex; align-items:center; gap:8px; height:32px; margin-bottom:32px; color:#ffffff; font-size:20px; font-weight:700; }
        .tc-company .tc-logo { width:32px; height:32px; background:#dc2626; border-radius:6px; flex:0 0 32px; }
        .tc-quote { color:#d4d4d8; font-size:18px; font-weight:400; line-height:1.7; margin-bottom:40px; }
        .tc-author { margin-top:auto; padding-top:24px; border-top:1px solid #18181b; display:flex; align-items:center; gap:16px; }
        .tc-avatar { width:56px; height:56px; border-radius:50%; border:2px solid #27272a; overflow:hidden; filter: grayscale(100%); flex:0 0 56px; }
        .tc-avatar img { width:100%; height:100%; object-fit:cover; display:block; }
        .tc-author-meta { display:flex; flex-direction:column; }
        .tc-author-name { color:#ffffff; font-size:16px; font-weight:600; margin-bottom:4px; }
        .tc-author-role { color:#71717a; font-size:14px; font-weight:400; }

        /* Right column: content */
        .tc-right { color:#ffffff; }
        .tc-tag { font-size:14px; font-weight:600; color:#dc2626; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:16px; }
        .tc-title { font-weight:700; letter-spacing:-0.025em; line-height:1.1; color:#ffffff; margin-bottom:24px; font-size:56px; }
        .tc-desc { color:#a1a1aa; font-size:18px; line-height:1.7; max-width:600px; margin-bottom:48px; }
        @media (max-width:1023.98px){ .tc-title{ font-size:40px; } .tc-desc{ font-size:16px; } }
        @media (min-width:1024px){ .tc-title{ font-size:72px; } }

        /* Nav buttons */
        .tc-nav { display:flex; align-items:center; gap:16px; }
        .tc-btn { width:56px; height:56px; border:1px solid #27272a; border-radius:28px; background:transparent; color:#ffffff; display:flex; align-items:center; justify-content:center; cursor:pointer; position:relative; overflow:hidden; transition:border-color 300ms ease, transform 100ms ease; }
        .tc-btn:active { transform: scale(0.95); }
        .tc-btn::before { content:""; position:absolute; inset:0; background:#ffffff; transform: scale(0); transition: transform 300ms ease; z-index:0; }
        .tc-btn:hover { border-color:#ffffff; }
        .tc-btn:hover::before { transform: scale(1); }
        .tc-btn svg { width:20px; height:20px; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; position:relative; z-index:1; }
        .tc-btn:hover svg { color:#000000; }

            /* Shuffle animation */
            @keyframes deck-shuffle {
                0% { transform: translate(-20px, -20px) rotate(-1deg); }
                50% { transform: translate(-10px, -10px) rotate(0.5deg); }
                100% { transform: translate(-20px, -20px) rotate(0deg); }
            }
            .tc-shuffle .tc-deck-card.d1 { animation: deck-shuffle 300ms ease; }
            .tc-shuffle .tc-deck-card.d2 { animation: deck-shuffle 300ms ease 30ms; }
            .tc-shuffle .tc-deck-card.d3 { animation: deck-shuffle 300ms ease 60ms; }
            .tc-shuffle .tc-deck-card.d4 { animation: deck-shuffle 300ms ease 90ms; }
    </style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>

    <div class="hero-content">
        <div class="hero-text">
            <h1 class="hero-title">
                <span class="nest-text">NEST</span>
                <span class="shoolini-text rolling-text">SHOOLINI</span>
            </h1>

        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="scroll-text">Scroll to discover</div>
        <div class="scroll-arrow">
            <div class="arrow-line"></div>
            <div class="arrow-head"></div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Campus Life, Reimagined</h2>
            <p class="section-subtitle">Transform your university experience with powerful tools designed specifically for Shoolini students. Connect, discover, and thrive in every aspect of campus life.</p>
        </div>

        <div class="features-list">
            <!-- Card 1 - Anonymous Confessions -->
            <div class="feature-card" id="confessions">
                <div class="card-head">
                    <div class="card-icon">🎭</div>
                    <h3 class="card-title">Confessions</h3>
                    <div class="card-badge">LIVE</div>
                </div>
                <p class="card-subtitle">Share your thoughts safely and connect with your campus community.</p>
                <div class="card-features">
                    <div class="card-feature"><div class="fi">🔒</div><div class="ft">100% anonymous posting</div></div>
                    <div class="card-feature"><div class="fi">💬</div><div class="ft">Real campus conversations</div></div>
                    <div class="card-feature"><div class="fi">🛡️</div><div class="ft">Moderated for safety</div></div>
                    <div class="card-feature"><div class="fi">⚡</div><div class="ft">Instant updates</div></div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">Post Confession</a>
                    <a href="#" class="btn btn-secondary">Browse Posts</a>
                </div>
                <div class="card-footer stats">
                    <div class="stat"><div class="num">2.4k+</div><div class="label">Confessions</div></div>
                    <div class="stat"><div class="num">850+</div><div class="label">Active Users</div></div>
                    <div class="stat"><div class="num">12k+</div><div class="label">Reactions</div></div>
                </div>
            </div>

            <!-- Card 2 - Student Marketplace -->
            <div class="feature-card" id="marketplace">
                <div class="card-head">
                    <div class="card-icon">🛒</div>
                    <h3 class="card-title">Marketplace</h3>
                    <div class="card-badge">LIVE</div>
                </div>
                <p class="card-subtitle">Buy, sell, or exchange books, gadgets, and essentials with students.</p>
                <div class="card-features">
                    <div class="card-feature"><div class="fi">📚</div><div class="ft">Books & study materials</div></div>
                    <div class="card-feature"><div class="fi">💻</div><div class="ft">Tech & gadgets</div></div>
                    <div class="card-feature"><div class="fi">✅</div><div class="ft">Verified student sellers</div></div>
                    <div class="card-feature"><div class="fi">💰</div><div class="ft">Best prices guaranteed</div></div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">Browse Items</a>
                    <a href="#" class="btn btn-secondary">Sell Now</a>
                </div>
                <div class="card-footer info">
                    <div class="info-item"><div class="ii">🔥</div><div class="it">New deals posted daily</div></div>
                    <div class="info-item"><div class="ii">⚡</div><div class="it">Instant chat with sellers</div></div>
                </div>
            </div>

            <!-- Card 3 - Campus Events -->
            <div class="feature-card" id="events">
                <div class="card-head">
                    <div class="card-icon">🎉</div>
                    <h3 class="card-title">Campus Events</h3>
                    <div class="card-badge">LIVE</div>
                </div>
                <p class="card-subtitle">Discover and track all college events, fests, and important deadlines.</p>
                <div class="card-features">
                    <div class="card-feature"><div class="fi">📅</div><div class="ft">Event calendar & reminders</div></div>
                    <div class="card-feature"><div class="fi">🎪</div><div class="ft">Fests & competitions</div></div>
                    <div class="card-feature"><div class="fi">🔔</div><div class="ft">Deadline notifications</div></div>
                    <div class="card-feature"><div class="fi">🎫</div><div class="ft">Quick RSVP & tickets</div></div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">View Calendar</a>
                    <a href="#" class="btn btn-secondary">Add Event</a>
                </div>
                <div class="card-footer stats">
                    <div class="stat"><div class="num">180+</div><div class="label">Events</div></div>
                    <div class="stat"><div class="num">2.1k+</div><div class="label">Attendees</div></div>
                    <div class="stat"><div class="num">45+</div><div class="label">Clubs</div></div>
                </div>
            </div>

            <!-- Card 4 - Lost & Found -->
            <div class="feature-card" id="lost-found">
                <div class="card-head">
                    <div class="card-icon">🔍</div>
                    <h3 class="card-title">Lost & Found</h3>
                    <div class="card-badge">LIVE</div>
                </div>
                <p class="card-subtitle">Report lost items or help others by listing what you've found on campus.</p>
                <div class="card-features">
                    <div class="card-feature"><div class="fi">📱</div><div class="ft">Quick item reporting</div></div>
                    <div class="card-feature"><div class="fi">🔎</div><div class="ft">Search lost items</div></div>
                    <div class="card-feature"><div class="fi">📸</div><div class="ft">Photo verification</div></div>
                    <div class="card-feature"><div class="fi">🤝</div><div class="ft">Direct contact owners</div></div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">Report Lost</a>
                    <a href="#" class="btn btn-secondary">Found Item</a>
                </div>
                <div class="card-footer info">
                    <div class="info-item"><div class="ii">✨</div><div class="it">Most items reunited within 48 hours</div></div>
                </div>
            </div>

            <!-- Card 5 - Ride Sharing -->
            <div class="feature-card" id="carpooling">
                <div class="card-head">
                    <div class="card-icon">🚗</div>
                    <h3 class="card-title">Ride Sharing</h3>
                    <div class="card-badge">LIVE</div>
                </div>
                <p class="card-subtitle">Share rides with fellow students to save money and travel smarter.</p>
                <div class="card-features">
                    <div class="card-feature"><div class="fi">💵</div><div class="ft">Split costs & save money</div></div>
                    <div class="card-feature"><div class="fi">🗺️</div><div class="ft">Popular routes covered</div></div>
                    <div class="card-feature"><div class="fi">👥</div><div class="ft">Student-only verified</div></div>
                    <div class="card-feature"><div class="fi">⏰</div><div class="ft">Flexible scheduling</div></div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">Find Ride</a>
                    <a href="#" class="btn btn-secondary">Offer Ride</a>
                </div>
                <div class="card-footer info">
                    <div class="info-item"><div class="ii">🌱</div><div class="it">Eco-friendly & sustainable travel</div></div>
                    <div class="info-item"><div class="ii">🛡️</div><div class="it">Safe rides with verified students</div></div>
                </div>
            </div>

            <!-- Card 6 - Accommodation Hub -->
            <div class="feature-card" id="accommodation">
                <div class="card-head">
                    <div class="card-icon">🏠</div>
                    <h3 class="card-title">Accommodation Hub</h3>
                    <div class="card-badge">LIVE</div>
                </div>
                <p class="card-subtitle">Find rooms, roommates, and verified listings near campus with ease.</p>
                <div class="card-features">
                    <div class="card-feature"><div class="fi">🏘️</div><div class="ft">Verified property listings</div></div>
                    <div class="card-feature"><div class="fi">👫</div><div class="ft">Roommate matching</div></div>
                    <div class="card-feature"><div class="fi">📍</div><div class="ft">Near campus locations</div></div>
                    <div class="card-feature"><div class="fi">💳</div><div class="ft">Budget-friendly options</div></div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary">Find Room</a>
                    <a href="#" class="btn btn-secondary">List Property</a>
                </div>
                <div class="card-footer stats">
                    <div class="stat"><div class="num">250+</div><div class="label">Properties</div></div>
                    <div class="stat"><div class="num">680+</div><div class="label">Students</div></div>
                    <div class="stat"><div class="num">95%</div><div class="label">Satisfaction</div></div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Why NEST (Rebuilt to Spec) -->
<section class="why2-section" id="why">
    <div class="why2-container">
        <!-- Title -->
        <h2 class="why2-title">Why <span id="why-nest-word">NEST?</span></h2>

        <!-- Benefits Grid -->
        <div class="why2-grid-wrap">
            <!-- Card 1 -->
            <article class="why2-card">
                <div class="why2-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"></path>
                        <path d="M12 22V4"></path>
                    </svg>
                </div>
                <h3 class="why2-card-title">Enterprise-Grade Security</h3>
                <p class="why2-card-desc">Built with security-first architecture. Multi-layer encryption, role-based access control, and audit logs keep your data protected.</p>
            </article>

            <!-- Card 2 -->
            <article class="why2-card">
                <div class="why2-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M13 2L3 14h7l-1 8 11-12h-7l1-8Z"></path>
                    </svg>
                </div>
                <h3 class="why2-card-title">Lightning Fast Performance</h3>
                <p class="why2-card-desc">Optimized for speed with intelligent caching, lazy loading, and efficient data structures that scale with your needs.</p>
            </article>

            <!-- Card 3 -->
            <article class="why2-card">
                <div class="why2-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="why2-card-title">Team Collaboration</h3>
                <p class="why2-card-desc">Real-time synchronization, shared workspaces, and seamless communication tools that keep everyone aligned.</p>
            </article>
        </div>

        <!-- Developer Message -->
        <div class="why2-dev">
            <span class="why2-marker" aria-hidden="true"></span>
            <p>"NEST wasn't built to chase trends or copy competitors. It was built because we were tired of tools that promised everything and delivered complexity."</p>
            <p>"We spent months talking to teams—designers frustrated by bloated interfaces, developers exhausted by poor documentation, managers drowning in feature overload. The pattern was clear: modern tools had lost sight of what matters."</p>
            <p>"So we stripped everything back. Every feature earned its place. Every interaction was refined until it felt effortless. We obsessed over the details others ignore—the way data loads, how errors surface, the rhythm of your daily workflow."</p>
            <p>"NEST is opinionated software. It doesn't try to be everything. It tries to be excellent at what it does. That's why teams switch and never look back."</p>

            <div class="why2-signature">
                <span class="why2-signature-line" aria-hidden="true"></span>
                <span class="why2-signature-text">THE DEVELOPER</span>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Carousel Section -->
<section class="tc-section" id="testimonials">
    <div class="tc-container">
        <div class="tc-grid">
            <!-- Left: Stacked Cards -->
                    <div class="tc-left">
                        <div class="tc-left-wrap" id="tc-left-wrap">
                            <div class="tc-deck" aria-hidden="true">
                                <div class="tc-deck-card d1"></div>
                                <div class="tc-deck-card d2"></div>
                                <div class="tc-deck-card d3"></div>
                                <div class="tc-deck-card d4"></div>
                            </div>
                            <div class="tc-stack" id="tc-stack" aria-live="polite">
                    <!-- Card 1 -->
                    <article class="tc-card" tabindex="0">
                        <div class="tc-company"><span class="tc-logo" aria-hidden="true"></span> SIMPLETIRE</div>
                        <p class="tc-quote">"Working with NEST has been an exceptional experience. Their support in launching our payment platform and assisting our team in ensuring everything ran smoothly post-integration has been invaluable. We are grateful for and look forward to our continued partnership!"</p>
                        <div class="tc-author">
                            <div class="tc-avatar" aria-hidden="true"><img alt="" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='56' height='56' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='20' r='10' fill='%233f3f46'/><rect x='10' y='34' width='36' height='14' rx='7' fill='%233f3f46'/></svg>"></div>
                            <div class="tc-author-meta">
                                <div class="tc-author-name">Max Zagor</div>
                                <div class="tc-author-role">DTC eCommerce Manager, SimpleTire</div>
                            </div>
                        </div>
                    </article>

                    <!-- Card 2 -->
                    <article class="tc-card" tabindex="0">
                        <div class="tc-company"><span class="tc-logo" aria-hidden="true"></span> TECHCORP</div>
                        <p class="tc-quote">"NEST transformed how our team collaborates. The interface is so intuitive that onboarding new members takes minutes, not days. We've seen a 40% increase in productivity since switching. The attention to detail is remarkable."</p>
                        <div class="tc-author">
                            <div class="tc-avatar" aria-hidden="true"><img alt="" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='56' height='56' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='20' r='10' fill='%233f3f46'/><rect x='10' y='34' width='36' height='14' rx='7' fill='%233f3f46'/></svg>"></div>
                            <div class="tc-author-meta">
                                <div class="tc-author-name">Sarah Chen</div>
                                <div class="tc-author-role">Product Lead at TechCorp</div>
                            </div>
                        </div>
                    </article>

                    <!-- Card 3 -->
                    <article class="tc-card" tabindex="0">
                        <div class="tc-company"><span class="tc-logo" aria-hidden="true"></span> HEALTHTECH</div>
                        <p class="tc-quote">"The security features give us complete peace of mind. Enterprise-grade encryption, detailed audit logs, and compliance certifications—all without sacrificing usability. It's exactly what we needed."</p>
                        <div class="tc-author">
                            <div class="tc-avatar" aria-hidden="true"><img alt="" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='56' height='56' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='20' r='10' fill='%233f3f46'/><rect x='10' y='34' width='36' height='14' rx='7' fill='%233f3f46'/></svg>"></div>
                            <div class="tc-author-meta">
                                <div class="tc-author-name">Dr. Aisha Patel</div>
                                <div class="tc-author-role">CTO at HealthTech Solutions</div>
                            </div>
                        </div>
                    </article>

                    <!-- Card 4 -->
                    <article class="tc-card" tabindex="0">
                        <div class="tc-company"><span class="tc-logo" aria-hidden="true"></span> STARTUPHUB</div>
                        <p class="tc-quote">"ROI was immediate. We've cut tool costs by 60% and improved team satisfaction scores across the board. NEST delivers on every promise. Finally, a tool that doesn't get in the way of actual work."</p>
                        <div class="tc-author">
                            <div class="tc-avatar" aria-hidden="true"><img alt="" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='56' height='56' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='20' r='10' fill='%233f3f46'/><rect x='10' y='34' width='36' height='14' rx='7' fill='%233f3f46'/></svg>"></div>
                            <div class="tc-author-meta">
                                <div class="tc-author-name">David Park</div>
                                <div class="tc-author-role">CEO at StartupHub</div>
                            </div>
                        </div>
                    </article>

                    <!-- Card 5 -->
                    <article class="tc-card" tabindex="0">
                        <div class="tc-company"><span class="tc-logo" aria-hidden="true"></span> DESIGNCO</div>
                        <p class="tc-quote">"We tried every collaboration platform out there. NEST is the only one that our entire team actually enjoys using. The design is beautiful and functional. It's become an essential part of our workflow."</p>
                        <div class="tc-author">
                            <div class="tc-avatar" aria-hidden="true"><img alt="" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='56' height='56' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='20' r='10' fill='%233f3f46'/><rect x='10' y='34' width='36' height='14' rx='7' fill='%233f3f46'/></svg>"></div>
                            <div class="tc-author-meta">
                                <div class="tc-author-name">James Kim</div>
                                <div class="tc-author-role">Design Director at DesignCo</div>
                            </div>
                        </div>
                                </article>
                                </div>
                            </div>
            </div>

            <!-- Right: Content + Nav -->
            <div class="tc-right">
                <div class="tc-tag">TESTIMONIALS</div>
                <h3 class="tc-title">What Our Users Say</h3>
                <p class="tc-desc">Real stories from teams who switched to NEST. Designed for clarity, built for speed, and refined until it disappears into your workflow. These are the results that matter.</p>
                <div class="tc-nav">
                    <button class="tc-btn" id="tc-prev" aria-label="Previous testimonial" type="button">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                    <button class="tc-btn" id="tc-next" aria-label="Next testimonial" type="button">
                        <svg viewBox="0 0 24 24" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </section>

<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <h3 class="footer-title">NEST SHOOLINI</h3>
                <p class="footer-tagline">Connecting campus life, one feature at a time</p>
            </div>

            <div class="footer-links">
                <div class="link-group">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="#confessions">Confessions</a></li>
                        <li><a href="#marketplace">Marketplace</a></li>
                        <li><a href="#events">Events</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Community</h4>
                    <ul>
                        <li><a href="#lost-found">Lost & Found</a></li>
                        <li><a href="#carpooling">Carpooling</a></li>
                        <li><a href="#accommodation">Accommodation</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#help">Help Center</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#privacy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; 2025 NEST Shoolini. All rights reserved.</p>
            </div>
            <div class="footer-credit">
                <p>Made with ❤️ by <span class="architect">The Architect</span></p>
            </div>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    (function() {
        const section = document.getElementById('why');
        if (!section || 'IntersectionObserver' in window === false) return;

        const cards = section.querySelectorAll('.why2-card');
        const dev = section.querySelector('.why2-dev');
        const paras = section.querySelectorAll('.why2-dev p');
        const sig = section.querySelector('.why2-signature');

        // One-time animation for benefit cards when the section first appears
        let cardsAnimated = false;
        const sectionObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !cardsAnimated) {
                    cardsAnimated = true;
                    cards.forEach((el, i) => {
                        setTimeout(() => el.classList.add('animate-in'), i * 150);
                    });
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        sectionObserver.observe(section);

        // Replaying animation for developer message every time it enters viewport
        let devTimers = [];
        const clearDevTimers = () => { devTimers.forEach(t => clearTimeout(t)); devTimers = []; };
        const resetAnim = (el) => { if (!el) return; el.classList.remove('animate-in'); void el.offsetWidth; };

        const devObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    clearDevTimers();
                    // Reset states so animations restart cleanly
                    resetAnim(dev);
                    paras.forEach(resetAnim);
                    resetAnim(sig);

                    // Play sequence relative to entry
                    devTimers.push(setTimeout(() => dev && dev.classList.add('animate-in'), 0));
                    paras.forEach((p, i) => {
                        devTimers.push(setTimeout(() => p.classList.add('animate-in'), 200 + i * 300));
                    });
                    devTimers.push(setTimeout(() => sig && sig.classList.add('animate-in'), 1400));
                } else {
                    // Optionally clear classes on exit to prepare for next entry
                    clearDevTimers();
                    resetAnim(dev);
                    paras.forEach(resetAnim);
                    resetAnim(sig);
                }
            });
        }, { threshold: 0.1 });
        if (dev) devObserver.observe(dev);
    })();
</script>
    <script>
        // Testimonials Carousel logic
            (function(){
            const stack = document.getElementById('tc-stack');
            if (!stack) return;
            const cards = Array.from(stack.querySelectorAll('.tc-card'));
            const prevBtn = document.getElementById('tc-prev');
            const nextBtn = document.getElementById('tc-next');
                const wrap = document.getElementById('tc-left-wrap');
            let currentIndex = 0;

            function applyState(card, {z, o, t}){
                card.style.zIndex = String(z);
                card.style.opacity = String(o);
                card.style.transform = t;
                card.style.pointerEvents = o > 0 ? 'auto' : 'none';
            }

            function updateCards(){
                const n = cards.length;
                for (let i=0;i<n;i++){
                    const rel = (i - currentIndex + n) % n;
                    if (rel === 0){ // front
                        applyState(cards[i], { z:3, o:1, t:'translateY(0) translateX(0) scale(1)' });
                    } else if (rel === 1){ // second
                        applyState(cards[i], { z:2, o:0.7, t:'translateY(20px) translateX(20px) scale(0.95)' });
                    } else if (rel === 2){ // third
                        applyState(cards[i], { z:1, o:0.4, t:'translateY(40px) translateX(40px) scale(0.9)' });
                    } else { // hidden
                        applyState(cards[i], { z:0, o:0, t:'translateY(-60px) translateX(-60px) scale(0.85)' });
                    }
                }
            }

                function triggerShuffle(){
                    if (!wrap) return;
                    wrap.classList.add('tc-shuffle');
                    setTimeout(()=> wrap.classList.remove('tc-shuffle'), 350);
                }

                function next(){ currentIndex = (currentIndex + 1) % cards.length; updateCards(); triggerShuffle(); }
                function prev(){ currentIndex = (currentIndex - 1 + cards.length) % cards.length; updateCards(); triggerShuffle(); }

            if (nextBtn) nextBtn.addEventListener('click', next);
            if (prevBtn) prevBtn.addEventListener('click', prev);
            // Keyboard support when a card is focused
            stack.addEventListener('keydown', (e)=>{
                if (e.key === 'ArrowRight') { next(); }
                if (e.key === 'ArrowLeft') { prev(); }
            });

            updateCards();
        })();
    </script>
@endsection
