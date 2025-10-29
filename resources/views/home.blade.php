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
                .why2-section .why2-title { text-align: center; color: #ffffff; font-weight: 700; letter-spacing: -0.025em; line-height: 1; margin-bottom: 96px; font-size: 72px; }
                @media (max-width:1199.98px){ .why2-section .why2-title { font-size: 48px; } }
                @media (max-width:767.98px){ .why2-section .why2-title { font-size: 36px; } }
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
    .why2-dev.animate-in { animation: fade-up 600ms ease-out forwards; }
    .why2-dev p.animate-in { animation: focus-in 750ms ease-out forwards; }
    .why2-dev p.dir-up.animate-in { animation: fade-down 600ms ease-out forwards; }
    .why2-signature.animate-in { animation: fade-up 600ms ease-out forwards; }
    /* Direction override for scroll-up */
    .why2-dev.dir-up.animate-in { animation: fade-down 600ms ease-out forwards; }
    .why2-signature.dir-up.animate-in { animation: fade-down 600ms ease-out forwards; }

    /* Keyframes */
    @keyframes pulse-breathing { 0%, 100% { opacity: 1; } 50% { opacity: 0.7; } }
    @keyframes fade-up { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes focus-in { from { opacity: 0; filter: blur(10px); } to { opacity: 1; filter: blur(0); } }
    @keyframes fade-down { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }

    /* Features title: match Wall of Love scale */
    .features-section .section-title { font-size: 72px; font-weight: 700; letter-spacing: -0.02em; line-height: 1.1; }
    @media (max-width:1199.98px){ .features-section .section-title { font-size: 48px; } }
    @media (max-width:767.98px){ .features-section .section-title { font-size: 36px; } }
</style>
    <!-- Removed Testimonials Carousel styles -->
    <style>
        /* Wall of Love (wl-*) */
        .wl-section { background:#000000; min-height:100vh; position:relative; overflow:hidden; display:block; }
        .wl-container { max-width:1400px; margin:0 auto; position:relative; z-index:1; padding:10px 24px; font-family: system-ui, -apple-system, sans-serif; }
            @media (max-width:767.98px){ .wl-container{ padding:80px 24px; } }

        /* Decorative elements */
        .wl-border-circle { position:absolute; top:50%; left:50%; width:1200px; height:1200px; border:1px solid #18181b; border-radius:50%; transform: translate(-50%, -50%); pointer-events:none; opacity:0.3; animation:pulse-border 8s ease-in-out infinite; }
        @media (min-width:768px) and (max-width:1199.98px){ .wl-border-circle{ width:1000px; height:1000px; } }
        @media (max-width:767.98px){ .wl-border-circle{ width:800px; height:800px; } }

        .wl-heart { position:absolute; top:15%; right:20%; width:80px; height:80px; opacity:0.15; pointer-events:none; animation: float 6s ease-in-out infinite; }
        .wl-heart svg { width:100%; height:100%; display:block; fill:#dc2626; stroke:#dc2626; stroke-width:1; }
        @media (max-width:767.98px){ .wl-heart{ top:10%; right:10%; width:60px; height:60px; } }

        /* Header */
        .wl-header { text-align:center; margin-bottom:80px; }
        .wl-badge { display:inline-block; padding:8px 20px; background: rgba(220,38,38,0.1); border:1px solid rgba(220,38,38,0.2); border-radius:24px; font-size:14px; font-weight:500; color:#dc2626; margin-bottom:24px; letter-spacing:0.02em; }
        .wl-title { font-weight:700; color:#ffffff; letter-spacing:-0.02em; line-height:1.1; margin-bottom:16px; font-size:72px; }
        .wl-subtitle { font-size:18px; font-weight:400; color:#a1a1aa; line-height:1.6; }
        @media (max-width:1199.98px){ .wl-title{ font-size:48px; } }
        @media (max-width:767.98px){ .wl-title{ font-size:36px; } .wl-subtitle{ font-size:16px; } }

    /* Rows + Scroller/Marquee */
    .wl-rows { display:flex; flex-direction:column; gap:24px; }
    .wl-scroller { position: relative; overflow: hidden; }
    .wl-scroller::before,
    .wl-scroller::after { content:""; position:absolute; top:0; bottom:0; width:80px; z-index:2; pointer-events:none; }
    .wl-scroller::before { left:0; background: linear-gradient(90deg, #000 0%, rgba(0,0,0,0) 100%); }
    .wl-scroller::after { right:0; background: linear-gradient(270deg, #000 0%, rgba(0,0,0,0) 100%); }

    .wl-scroller { padding: 10px 0; }
    .wl-track { display:flex; align-items:stretch; gap:24px; will-change: transform; animation: wl-marquee var(--wl-marquee-duration, 60s) linear infinite; }
    .wl-track.wl-track--reverse { animation-direction: reverse; }
    @media (max-width:767.98px){ .wl-track{ gap:16px; } }

    @keyframes wl-marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* Card */
    .testimonial-card { background:#000000; border:1px solid #18181b; border-radius:20px; padding:20px; position:relative; overflow:hidden; transition: all 400ms cubic-bezier(0.4,0,0.2,1); cursor:default; flex:0 0 260px; min-height: 140px; display:flex; flex-direction:column; justify-content:space-between; }
    @media (max-width:767.98px){ .testimonial-card{ padding:18px; flex-basis: 200px; } }
        .testimonial-card::before { content:""; position:absolute; inset:0; background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(220, 38, 38, 0.08), transparent 50%); opacity:0; transition: opacity 400ms; border-radius:20px; z-index:0; }
        .testimonial-card:hover { border-color:#27272a; background:#09090b; transform: translateY(-4px); }
        .testimonial-card:hover::before { opacity:1; }

        /* Inconsistent size variations */
    .wl-track .testimonial-card:nth-child(3n) { min-height: 150px; padding-top: 24px; padding-bottom: 24px; }
    .wl-track .testimonial-card:nth-child(4n) { min-height: 160px; padding-top: 26px; padding-bottom: 26px; }
    .wl-track .testimonial-card:nth-child(5n) { min-height: 150px; }
    @media (max-width: 767.98px){ .wl-track .testimonial-card:nth-child(4n) { min-height: 150px; } }

        /* Card content */
    .tc-text { font-size:15px; font-weight:400; color:#d4d4d8; line-height:1.7; position:relative; z-index:1; font-style: italic; }
    .tc-text .highlight { color:#dc2626; font-weight:500; }

    .tc-footer { display:flex; align-items:center; gap:10px; margin-top:16px; position:relative; z-index:1; }
    .tc-avatar { width:40px; height:40px; border-radius:50%; border:2px solid #27272a; overflow:hidden; filter: grayscale(100%); flex:0 0 40px; }
        .tc-avatar img { width:100%; height:100%; object-fit:cover; display:block; }
    .tc-meta { display:flex; flex-direction:column; gap:2px; }
    .tc-name { font-size:14px; font-weight:600; color:#ffffff; line-height:1.2; }
    .tc-role { font-size:12px; font-weight:400; color:#71717a; line-height:1.2; }

        /* Keyframes for decorative elements */
        @keyframes pulse-border {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity:0.3; }
            50% { transform: translate(-50%, -50%) scale(1.05); opacity:0.5; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Accessibility: focus-visible ring for keyboard users */
    :where(a, button, .cta-btn, .features-section a, .footer-section a):focus-visible { outline: 2px solid #dc2626; outline-offset: 3px; }

        /* Reduced motion preferences */
        @media (prefers-reduced-motion: reduce){
            .cta-btn { transition: none; }
            .cta-btn:hover { transform: none; box-shadow: none; }
            .why2-card.animate-in, .why2-dev.animate-in, .why2-dev p.animate-in, .why2-signature.animate-in { animation-duration: 400ms !important; }
        }

    /* CTA Section */
    .cta-section { background:#000; border-top:1px solid #111; border-bottom:1px solid #111; }
    .cta-container { max-width:1200px; margin:0 auto; padding:60px 24px; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:60px; text-align:center; }
    @media (max-width: 767.98px){ .cta-container { padding:72px 24px; gap:16px; } }

    .cta-btn { display:inline-flex; align-items:center; justify-content:center; padding:14px 32px; border-radius:14px; border:1px solid #dc2626; color:#ffffff; font-weight:700; letter-spacing:0.02em; text-decoration:none; background: rgba(220,38,38,0.06); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: background 180ms ease, box-shadow 180ms ease, transform 120ms ease; }
    .cta-btn:hover { background: rgba(220,38,38,0.18); box-shadow: 0 8px 28px rgba(220,38,38,0.25); transform: translateY(-1px); }
    .cta-btn:active { transform: translateY(0); box-shadow: 0 4px 18px rgba(220,38,38,0.2); }

    .cta-title { font-weight:800; letter-spacing:-0.02em; line-height:1.1; color:#fff; font-size:44px; }
    @media (min-width: 1200px){ .cta-title { font-size:60px; } }
    @media (max-width: 767.98px){ .cta-title { font-size:32px; } }
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

    <!-- Wall of Love Section -->
    <section class="wl-section" id="wall-of-love">
        <!-- Decorative elements -->
        <div class="wl-border-circle" aria-hidden="true"></div>
        <div class="wl-heart" aria-hidden="true">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </div>

        <div class="wl-container">
            <header class="wl-header">
                <span class="wl-badge">Wall of love</span>
                <h2 class="wl-title">Loved by thinkers</h2>
                <p class="wl-subtitle">Here's what people are saying about us</p>
            </header>

            <div class="wl-rows">
                <!-- Row 1 (default direction) -->
                <div class="wl-scroller" data-row="1">
                    <div class="wl-track">
                        <!-- Card 1 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"NEST makes campus life simple. I found a used textbook in minutes and sold my old one the same day."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Aanya Sharma" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Aanya Sharma</div><div class="tc-role">B.Tech CSE, 2nd Year</div></div>
                            </div>
                        </article>
                        <!-- Card 2 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"The events calendar is a lifesaver. I don’t miss club deadlines anymore, and RSVPs are super quick."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Rohan Verma" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Rohan Verma</div><div class="tc-role">MBA, Marketing</div></div>
                            </div>
                        </article>
                        <!-- Card 3 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"I matched with a roommate through NEST’s accommodation hub. Verified listings made it stress-free."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Priya Mehta" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Priya Mehta</div><div class="tc-role">Biotechnology, 3rd Year</div></div>
                            </div>
                        </article>
                        <!-- Card 4 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"Ride sharing on NEST is brilliant. Safer, cheaper, and I’ve met great people on the same route."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Karan Singh" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Karan Singh</div><div class="tc-role">MCA, 1st Year</div></div>
                            </div>
                        </article>
                        <!-- Card 5 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"Confessions feel safe and well-moderated. It’s an honest space that still respects boundaries."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Neha Gupta" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Neha Gupta</div><div class="tc-role">Design Club Lead</div></div>
                            </div>
                        </article>
                        <!-- Card 6 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"From books to gadgets, the marketplace helped me save money without leaving campus."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Aditya Rao" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Aditya Rao</div><div class="tc-role">ECE, 4th Year</div></div>
                            </div>
                        </article>
                    </div>
                </div>
                <!-- Row 2 (reverse direction) -->
                <div class="wl-scroller" data-row="2">
                    <div class="wl-track wl-track--reverse">
                        <!-- Card 1 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"NEST centralizes what students actually use. It’s faster to communicate updates and reduce clutter in groups."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Prof. Meera Kapoor" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Prof. Meera Kapoor</div><div class="tc-role">Assistant Professor, CSE</div></div>
                            </div>
                        </article>
                        <!-- Card 2 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"From counseling to clubs, NEST gives a real-time pulse of campus. It’s improved participation across fests."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Dr. Anil Bhatia" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Dr. Anil Bhatia</div><div class="tc-role">Dean, Student Affairs</div></div>
                            </div>
                        </article>
                        <!-- Card 3 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"Our placement notices reach students instantly through NEST. Communication is clearer and timely."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Ms. Ritu Malhotra" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Ms. Ritu Malhotra</div><div class="tc-role">Placement Coordinator</div></div>
                            </div>
                        </article>
                        <!-- Card 4 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"The entrepreneur cell uses NEST to announce sessions and connect mentors with students seamlessly."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Prof. Arjun Sethi" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Prof. Arjun Sethi</div><div class="tc-role">Faculty Advisor, E-Cell</div></div>
                            </div>
                        </article>
                        <!-- Card 5 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"I wish we had NEST back in 2019. It’s the kind of tool that makes campus feel connected and efficient."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Mr. Sahil Khanna" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Mr. Sahil Khanna</div><div class="tc-role">Alumni, 2019</div></div>
                            </div>
                        </article>
                        <!-- Card 6 -->
                        <article class="testimonial-card">
                            <p class="tc-text">"Clean design and quick load times. NEST respects attention and helps students focus on what matters."</p>
                            <div class="tc-footer">
                                <div class="tc-avatar"><img alt="Dr. Kavya Iyer" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 56 56'><rect width='56' height='56' fill='%2327272a'/><circle cx='28' cy='22' r='10' fill='%233f3f46'/><rect x='14' y='34' width='28' height='10' rx='5' fill='%233f3f46'/></svg>"></div>
                                <div class="tc-meta"><div class="tc-name">Dr. Kavya Iyer</div><div class="tc-role">Associate Professor, Management</div></div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="cta">
        <div class="cta-container">
            <a href="/dashboard" class="cta-btn" aria-label="Explore NEST features">Visit Dashboard</a>
            <h3 class="cta-title">Your campus. Your people. Your space</h3>
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

        let lastScrollY = window.scrollY;
        const devObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const scrollingUp = window.scrollY < lastScrollY;
                    clearDevTimers();
                    // Reset states so animations restart cleanly
                    resetAnim(dev); resetAnim(sig);
                    paras.forEach(resetAnim);

                    // Set direction classes based on scroll direction
                    if (scrollingUp) {
                        dev.classList.add('dir-up');
                        sig.classList.add('dir-up');
                        paras.forEach(p=>p.classList.add('dir-up'));
                    } else {
                        dev.classList.remove('dir-up');
                        sig.classList.remove('dir-up');
                        paras.forEach(p=>p.classList.remove('dir-up'));
                    }

                    // Play sequence relative to entry
                    devTimers.push(setTimeout(() => dev && dev.classList.add('animate-in'), 0));

                    if (scrollingUp) {
                        // Animate from bottom to top: reverse paragraph order and invert stagger
                        const rev = Array.from(paras).slice().reverse();
                        rev.forEach((p, i) => {
                            devTimers.push(setTimeout(() => p.classList.add('animate-in'), 150 + i * 180));
                        });
                        devTimers.push(setTimeout(() => sig && sig.classList.add('animate-in'), 850));
                    } else {
                        // Normal: top to bottom
                        paras.forEach((p, i) => {
                            devTimers.push(setTimeout(() => p.classList.add('animate-in'), 150 + i * 220));
                        });
                        devTimers.push(setTimeout(() => sig && sig.classList.add('animate-in'), 950));
                    }
                } else {
                    // Optionally clear classes on exit to prepare for next entry
                    clearDevTimers();
                    resetAnim(dev);
                    paras.forEach(resetAnim);
                    resetAnim(sig);
                }
            });
            lastScrollY = window.scrollY;
        }, { threshold: 0.1 });
        if (dev) devObserver.observe(dev);
    })();
</script>
    <!-- Removed Testimonials Carousel logic -->
        <script>
            // Wall of Love: marquee + mouse tracking for radial glow
            (function(){
                const root = document.getElementById('wall-of-love');
                if (!root) return;
                const scrollers = Array.from(root.querySelectorAll('.wl-scroller'));
                if (!scrollers.length) return;

                const attachGlow = (card) => {
                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = ((e.clientX - rect.left) / rect.width) * 100;
                        const y = ((e.clientY - rect.top) / rect.height) * 100;
                        card.style.setProperty('--mouse-x', x + '%');
                        card.style.setProperty('--mouse-y', y + '%');
                    });
                };

                const setupRow = (scroller) => {
                    if (scroller.dataset.initialized === 'true') return;
                    const track = scroller.querySelector('.wl-track');
                    if (!track) return;
                    const style = getComputedStyle(track);
                    const GAP_PX = parseInt(style.columnGap || style.gap || '24', 10) || 24;

                    // Duplicate for seamless loop
                    const originals = Array.from(track.children);
                    originals.forEach(node => track.appendChild(node.cloneNode(true)));

                    // Attach glow to originals + clones
                    track.querySelectorAll('.testimonial-card').forEach(attachGlow);

                    // Compute duration per row
                    const computeDuration = () => {
                        const firstHalf = Array.from(track.children).slice(0, originals.length);
                        const totalWidth = firstHalf.reduce((sum, el, i) => sum + el.getBoundingClientRect().width + (i > 0 ? GAP_PX : 0), 0);
                        const pxPerSecond = 80; // base speed
                        const seconds = Math.max(25, Math.min(120, totalWidth / pxPerSecond));
                        scroller.style.setProperty('--wl-marquee-duration', seconds + 's');
                        track.style.animationName = 'wl-marquee';
                        track.style.animationDuration = seconds + 's';
                        track.style.animationTimingFunction = 'linear';
                        track.style.animationIterationCount = 'infinite';
                        track.style.animationPlayState = 'running';
                    };
                    setTimeout(computeDuration, 0);
                    window.addEventListener('resize', () => setTimeout(computeDuration, 100));

                    // Reduced motion: slow down per row
                    const media = window.matchMedia('(prefers-reduced-motion: reduce)');
                    const applyMotionPref = () => {
                        const dur = parseFloat(getComputedStyle(scroller).getPropertyValue('--wl-marquee-duration')) || 60;
                        if (media.matches) track.style.animationDuration = Math.min(dur * 2, 180) + 's';
                        track.style.animationPlayState = 'running';
                    };
                    media.addEventListener ? media.addEventListener('change', applyMotionPref) : media.addListener(applyMotionPref);
                    applyMotionPref();
                    scroller.dataset.initialized = 'true';
                };

                scrollers.forEach(setupRow);
            })();
        </script>
@endsection
