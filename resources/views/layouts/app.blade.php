<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'NEST Shoolini - Your Campus Connection Hub')</title>
    <meta name="description" content="@yield('description', 'Connect with your campus community through confessions, marketplace, events, and more at Shoolini University.')" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Static Assets (no build) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
    <script defer src="{{ asset('js/app.js') }}?v={{ @filemtime(public_path('js/app.js')) }}"></script>

    @yield('head')
</head>
<body>
    <!-- Header Navigation -->
    <header class="main-header">
        <nav class="header-nav">
            <div class="nav-container">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-dropdown="features">
                            Features
                            <span class="dropdown-arrow">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6,9 12,15 18,9"></polyline>
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-dropdown="community">
                            Community
                            <span class="dropdown-arrow">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6,9 12,15 18,9"></polyline>
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-dropdown="services">
                            Services
                            <span class="dropdown-arrow">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6,9 12,15 18,9"></polyline>
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Dropdown Menus -->
        <div class="dropdown-container">
            <div id="features-dropdown" class="dropdown-panel" style="display: none;">
                <div class="dropdown-content">
                    <div class="dropdown-section">
                        <h4 class="dropdown-section-title">FEATURES</h4>
                        <div class="dropdown-items">
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Anonymous Confessions</div>
                                <div class="link-description">Share thoughts anonymously</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Student Marketplace</div>
                                <div class="link-description">Buy and sell campus items</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Campus Events</div>
                                <div class="link-description">Never miss any event</div>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown-section">
                        <h4 class="dropdown-section-title">CORE TOOLS</h4>
                        <div class="dropdown-items">
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Student Directory</div>
                                <div class="link-description">Connect with classmates</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Academic Resources</div>
                                <div class="link-description">Study materials and notes</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Discussion Forums</div>
                                <div class="link-description">Academic discussions</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="community-dropdown" class="dropdown-panel" style="display: none;">
                <div class="dropdown-content">
                    <div class="dropdown-section">
                        <h4 class="dropdown-section-title">COMMUNITY</h4>
                        <div class="dropdown-items">
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Lost & Found</div>
                                <div class="link-description">Recover lost items</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Ride Sharing</div>
                                <div class="link-description">Share rides and save money</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Study Groups</div>
                                <div class="link-description">Find study partners</div>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown-section">
                        <h4 class="dropdown-section-title">SOCIAL HUB</h4>
                        <div class="dropdown-items">
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Campus Social</div>
                                <div class="link-description">Connect and socialize</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Interest Groups</div>
                                <div class="link-description">Join hobby communities</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Mentorship</div>
                                <div class="link-description">Guide and be guided</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="services-dropdown" class="dropdown-panel" style="display: none;">
                <div class="dropdown-content">
                    <div class="dropdown-section">
                        <h4 class="dropdown-section-title">SERVICES</h4>
                        <div class="dropdown-items">
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Accommodation Hub</div>
                                <div class="link-description">Find rooms and roommates</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Student Support</div>
                                <div class="link-description">Get help and guidance</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Career Center</div>
                                <div class="link-description">Job and internship portal</div>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown-section">
                        <h4 class="dropdown-section-title">ADMINISTRATION</h4>
                        <div class="dropdown-items">
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Document Requests</div>
                                <div class="link-description">Certificates and transcripts</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Fee Payments</div>
                                <div class="link-description">Online payment portal</div>
                            </a>
                            <a href="#" class="dropdown-link">
                                <div class="link-title">Academic Calendar</div>
                                <div class="link-description">Important dates and deadlines</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    @yield('scripts')
</body>
</html>
