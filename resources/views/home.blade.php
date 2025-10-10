@extends('layouts.app')

@section('title', 'NEST Shoolini - Your Ultimate Campus Hub')
@section('description', 'Connect, share, and discover everything happening at Shoolini University. From anonymous confessions to marketplace deals, events, and more.')

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

<!-- Why NEST Section -->
<section class="why-section" id="why">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Why NEST</h2>
            <p class="section-subtitle">Built for Shoolini students to make campus life simpler, safer, and more connected—all in one place.</p>
        </div>

        <div class="why-list">
            <div class="why-card">
                <div class="why-head">
                    <div class="why-icon">🎓</div>
                    <h3 class="why-title">Built for Shoolini</h3>
                </div>
                <p class="why-text">Every feature is designed around real student needs—from classes to campus events to community life.</p>
            </div>

            <div class="why-card">
                <div class="why-head">
                    <div class="why-icon">🛡️</div>
                    <h3 class="why-title">Safe & Moderated</h3>
                </div>
                <p class="why-text">Anonymity where it matters, with strong reporting and review to keep the community respectful.</p>
            </div>

            <div class="why-card">
                <div class="why-head">
                    <div class="why-icon">🧭</div>
                    <h3 class="why-title">Everything in One Hub</h3>
                </div>
                <p class="why-text">Confessions, marketplace, events, rides, and rooms—no more juggling multiple groups and apps.</p>
            </div>

            <div class="why-card">
                <div class="why-head">
                    <div class="why-icon">⚡</div>
                    <h3 class="why-title">Fast & Lightweight</h3>
                </div>
                <p class="why-text">Snappy experience with a clean, minimal UI that works great on campus networks.</p>
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
