// ShooliniCentral - Interactive Landing Page

console.log('ShooliniCentral loaded');

class NestShoolini {
    constructor() {
        this.init();
    }

    init() {
        this.setupDropdownNavigation();
        this.setupScrollAnimations();
        this.setupTextEffects();
        this.setupFeatureCards();
        this.setupSmoothScrolling();
        console.log('NEST Shoolini initialized');
    }

    // Dropdown navigation functionality
    setupDropdownNavigation() {
        const navLinks = document.querySelectorAll('.nav-link[data-dropdown]');
        const dropdowns = document.querySelectorAll('.dropdown-panel');
        let activeDropdown = null;
        let activeLink = null;

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetDropdown = document.getElementById(link.dataset.dropdown + '-dropdown');

                // Remove active class from all links
                navLinks.forEach(navLink => navLink.classList.remove('active'));

                // Close all dropdowns first
                dropdowns.forEach(dropdown => {
                    if (dropdown !== targetDropdown) {
                        dropdown.style.display = 'none';
                    }
                });

                // Toggle the clicked dropdown
                if (activeDropdown === targetDropdown && targetDropdown.style.display === 'block') {
                    targetDropdown.style.display = 'none';
                    activeDropdown = null;
                    activeLink = null;
                } else {
                    targetDropdown.style.display = 'block';
                    activeDropdown = targetDropdown;
                    activeLink = link;
                    link.classList.add('active');
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.main-header')) {
                dropdowns.forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
                navLinks.forEach(navLink => navLink.classList.remove('active'));
                activeDropdown = null;
                activeLink = null;
            }
        });

        // Close dropdowns on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                dropdowns.forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
                navLinks.forEach(navLink => navLink.classList.remove('active'));
                activeDropdown = null;
                activeLink = null;
            }
        });
    }

    // Scroll-based animations
    setupScrollAnimations() {
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all feature cards
        document.querySelectorAll('.feature-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = `all 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.1}s`;
            observer.observe(card);
        });
    }

    // Text hover and animation effects
    setupTextEffects() {
        this.setupRollingTitle();
    }

    // Replace sliding words with rolling title on SHOOLINI span
    setupRollingTitle() {
        const el = document.querySelector('.rolling-text');
        if (!el) return;

        const words = ['confessions', 'marketplace', 'events', 'community', 'connections'];
        let idx = 0;

        const showWord = (text) => {
            el.classList.remove('is-visible');
            el.classList.add('is-leaving');
            setTimeout(() => {
                el.textContent = text.toUpperCase();
                el.classList.remove('is-leaving');
                el.classList.add('is-entering');
                requestAnimationFrame(() => {
                    el.classList.remove('is-entering');
                    el.classList.add('is-visible');
                });
            }, 150); // slightly faster for snappier sideways roll
        };

        // initialize
        el.classList.add('is-visible');
        // start cycle after short delay
        setInterval(() => {
            showWord(words[idx]);
            idx = (idx + 1) % words.length;
        }, 2200); // tighter cadence to match 0.25s transitions
    }

    // Create floating particles on text hover
    createTextParticles(element) {
        const particles = 5;
        const rect = element.getBoundingClientRect();

        for (let i = 0; i < particles; i++) {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: fixed;
                width: 4px;
                height: 4px;
                background: var(--accent-blue);
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                left: ${rect.left + Math.random() * rect.width}px;
                top: ${rect.top + Math.random() * rect.height}px;
                animation: particleFloat 1.5s ease-out forwards;
            `;

            document.body.appendChild(particle);

            // Remove particle after animation
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 1500);
        }
    }

    // Feature card interactions
    setupFeatureCards() {
        const cards = document.querySelectorAll('.feature-card');

        cards.forEach(card => {
            // Tilt effect on hover
            card.addEventListener('mouseenter', (e) => {
                this.addTiltEffect(e.target);
            });

            card.addEventListener('mouseleave', (e) => {
                this.removeTiltEffect(e.target);
            });

            card.addEventListener('mousemove', (e) => {
                this.updateTilt(e);
            });

            // Click ripple effect
            card.addEventListener('click', (e) => {
                this.createRipple(e);
            });
        });
    }

    // Tilt effect for cards
    addTiltEffect(card) {
        card.style.transformOrigin = 'center center';
        card.style.transition = 'transform 0.1s ease-out';
    }

    removeTiltEffect(card) {
        card.style.transform = 'translateY(-8px) rotateX(0deg) rotateY(0deg)';
        card.style.transition = 'transform 0.3s ease-out';
    }

    updateTilt(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = (y - centerY) / centerY * -10;
        const rotateY = (x - centerX) / centerX * 10;

        card.style.transform = `translateY(-8px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    }

    // Ripple effect on card click
    createRipple(e) {
        const card = e.currentTarget;
        const ripple = document.createElement('div');
        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        ripple.style.cssText = `
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: scale(0);
            left: ${x - 10}px;
            top: ${y - 10}px;
            pointer-events: none;
            animation: rippleEffect 0.6s ease-out;
        `;

        card.style.position = 'relative';
        card.appendChild(ripple);

        setTimeout(() => {
            if (ripple.parentNode) {
                ripple.parentNode.removeChild(ripple);
            }
        }, 600);
    }

    // Smooth scrolling for navigation
    setupSmoothScrolling() {
        // Scroll indicator click
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', () => {
                const featuresSection = document.querySelector('.features-section');
                if (featuresSection) {
                    featuresSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        }

        // Hero CTA buttons
        const ctaButtons = document.querySelectorAll('.hero-cta .glass-btn');
        ctaButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                if (index === 0) {
                    // "Explore Now" - scroll to features
                    const featuresSection = document.querySelector('.features-section');
                    if (featuresSection) {
                        featuresSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                } else {
                    // "Learn More" - scroll to footer
                    const footer = document.querySelector('.footer-section');
                    if (footer) {
                        footer.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    }
}

// Add CSS animations dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes particleFloat {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(-100px) scale(0);
        }
    }

    @keyframes rippleEffect {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(20);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new NestShoolini();
});

// Add loading screen fade out
window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease-in-out';

    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});
