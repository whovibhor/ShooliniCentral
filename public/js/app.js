// ShooliniCentral - Vanilla JS interactions (static, no build)

(function () {
    class NestShoolini {
        constructor() {
            this.dropdownState = { open: null };
            this.rollingWords = ['CONFESSIONS', 'MARKETPLACE', 'EVENTS', 'COMMUNITY', 'CONNECTIONS'];
            this.rollingIndex = 0;
        }

        init() {
            this.setupDropdownNavigation();
            this.setupScrollAnimations();
            this.setupFeatureCards();
            this.setupSmoothScrolling();
            this.setupRollingTitle();
            this.setupCountUpStats();
            this.setupWhyReveal();
            this.setupWhyParallax();
        }

        setupDropdownNavigation() {
            const nav = document.querySelector('.main-header');
            if (!nav) return;

            const dropdownToggles = nav.querySelectorAll('[data-dropdown]');
            dropdownToggles.forEach((toggle) => {
                const id = toggle.getAttribute('data-dropdown');
                let panel = document.getElementById(id);
                if (!panel) {
                    // support ids like "features-dropdown"
                    panel = document.getElementById(`${id}-dropdown`);
                }
                if (!panel) return;

                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const isSame = this.dropdownState.open === id;
                    this.closeAllDropdowns();
                    if (!isSame) {
                        toggle.classList.add('active');
                        panel.style.display = 'block';
                        this.dropdownState.open = id;
                    }
                });
            });

            document.addEventListener('click', (e) => {
                const insideHeader = e.target.closest('.main-header');
                if (!insideHeader) this.closeAllDropdowns();
            });
        }

        // Staggered reveal for Why NEST cards
        setupWhyReveal() {
            const cards = document.querySelectorAll('.why-list .why-card, .why-articles .why-article, .why-grid .why-benefit');
            if (!cards.length) return;
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('why-visible');
                    } else {
                        // Remove to allow re-animate on re-entry
                        entry.target.classList.remove('why-visible');
                    }
                });
            }, { threshold: 0.2 });
            cards.forEach((c) => obs.observe(c));
        }

        // Parallax effects for Why NEST section
        setupWhyParallax() {
            const section = document.querySelector('.why-section');
            if (!section) return;

            const parallaxEls = section.querySelectorAll('[data-parallax]');
            const onScroll = () => {
                const rect = section.getBoundingClientRect();
                const vh = window.innerHeight || document.documentElement.clientHeight;
                // Visible progress: 0 at entering, 1 at leaving
                const start = Math.min(1, Math.max(0, 1 - rect.top / vh));
                parallaxEls.forEach((el) => {
                    const speedAttr = el.getAttribute('speed');
                    const speed = speedAttr ? parseFloat(speedAttr) : 0;
                    const rotate = parseFloat(el.getAttribute('data-rotate') || '0');
                    const ty = start * speed; // px offset multiplier
                    const transform = `translateY(${ty}px) rotate(${rotate ? rotate * (start) : 0}deg)`;
                    el.style.transform = transform;
                    el.style.willChange = 'transform';
                    el.style.transition = 'transform 0.1s ease-out';
                });
            };

            // Initial and scroll updates
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);
        }

        closeAllDropdowns() {
            document.querySelectorAll('.nav-link.active').forEach((el) => el.classList.remove('active'));
            document.querySelectorAll('.dropdown-panel').forEach((panel) => (panel.style.display = 'none'));
            this.dropdownState.open = null;
        }

        setupScrollAnimations() {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in-view');
                            // Ensure CSS hover transforms can take effect
                            entry.target.style.opacity = '1';
                            entry.target.style.removeProperty('transform');
                        }
                    });
                },
                { threshold: 0.15 }
            );

            document.querySelectorAll('.feature-card').forEach((card) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });

            const style = document.createElement('style');
            // Only force opacity via class; avoid overriding transform so :hover can pop
            style.textContent = `.feature-card.in-view{opacity:1!important;}`;
            document.head.appendChild(style);
        }

        setupFeatureCards() {
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach((card) => {
                let rafId = null;
                let baseTransform = '';
                let moved = false;
                card.addEventListener('mouseenter', () => {
                    moved = false;
                    baseTransform = 'scale(1.04) translateY(-4px)';
                    // Pop in with CSS transition
                    card.style.transition = 'transform 180ms cubic-bezier(0.2, 0.8, 0.2, 1)';
                    card.style.transform = baseTransform;
                });
                card.addEventListener('mouseleave', () => {
                    baseTransform = '';
                    moved = false;
                    // Restore CSS-defined transition
                    card.style.removeProperty('transition');
                    // Clear inline so card returns to CSS-controlled state
                    card.style.removeProperty('transform');
                });
                function onMove(e) {
                    const rect = card.getBoundingClientRect();
                    const cx = rect.left + rect.width / 2;
                    const cy = rect.top + rect.height / 2;
                    const dx = (e.clientX - cx) / rect.width;
                    const dy = (e.clientY - cy) / rect.height;
                    const rotateX = dy * -6;
                    const rotateY = dx * 6;
                    if (rafId) cancelAnimationFrame(rafId);
                    rafId = requestAnimationFrame(() => {
                        // First movement: drop transition to avoid lag
                        if (!moved) {
                            card.style.transition = 'transform 60ms linear';
                            moved = true;
                        }
                        // Compose tilt with base hover transform
                        card.style.transform = `${baseTransform} rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                    });
                }
                function onLeave() {
                    if (rafId) cancelAnimationFrame(rafId);
                    // No-op: mouseleave handler clears inline transform
                }
                card.addEventListener('mousemove', onMove);
                card.addEventListener('mouseleave', onLeave);
            });
        }

        setupSmoothScrolling() {
            document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                anchor.addEventListener('click', (e) => {
                    const href = anchor.getAttribute('href');
                    if (href && href.length > 1) {
                        const el = document.querySelector(href);
                        if (el) {
                            e.preventDefault();
                            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            });
        }

        setupRollingTitle() {
            const el = document.querySelector('.rolling-text');
            if (!el) return;

            const swap = () => {
                el.classList.remove('is-visible');
                el.classList.add('is-leaving');

                setTimeout(() => {
                    this.rollingIndex = (this.rollingIndex + 1) % this.rollingWords.length;
                    el.textContent = this.rollingWords[this.rollingIndex];
                    el.classList.remove('is-leaving');
                    el.classList.add('is-entering');
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            el.classList.remove('is-entering');
                            el.classList.add('is-visible');
                        });
                    });
                }, 250);
            };

            el.classList.add('is-visible');
            setInterval(swap, 2200);
        }

        // Count-up effect for stats numbers (preserve shorthand like 2.4k+, 12k+, 95%)
        setupCountUpStats() {
            const footers = document.querySelectorAll('.card-footer.stats');
            if (!footers.length) return;

            // Parse original text to extract numeric target and display meta
            const parseMeta = (text) => {
                const trimmed = text.trim();
                const hasPlus = /\+$/.test(trimmed);
                const hasPercent = /%$/.test(trimmed);
                // Remove trailing plus/percent for parsing
                const core = trimmed.replace(/[+%]+$/g, '').trim();
                const m = core.match(/^([0-9]*\.?[0-9]+)\s*([kKmM]?)$/);
                if (!m) {
                    // Fallback: try integer without suffix
                    const n = parseInt(core, 10);
                    return { target: isNaN(n) ? 0 : n, suffix: '', decimals: 0, plus: hasPlus, percent: hasPercent };
                }
                const numStr = m[1];
                const decimals = (numStr.split('.')[1] || '').length;
                let value = parseFloat(numStr);
                const suffixRaw = (m[2] || '').toLowerCase();
                let target = value;
                if (suffixRaw === 'k') target = value * 1000;
                else if (suffixRaw === 'm') target = value * 1000000;
                return { target: Math.round(target), suffix: suffixRaw, decimals, plus: hasPlus, percent: hasPercent };
            };

            const formatDisplay = (value, meta) => {
                const { suffix, decimals, plus, percent } = meta;
                let out = '';
                if (percent) {
                    out = `${Math.round(value)}%`;
                } else if (suffix === 'k') {
                    const v = value / 1000;
                    out = decimals > 0 ? `${v.toFixed(decimals)}k` : `${Math.round(v)}k`;
                } else if (suffix === 'm') {
                    const v = value / 1000000;
                    out = decimals > 0 ? `${v.toFixed(decimals)}m` : `${Math.round(v)}m`;
                } else {
                    out = `${Math.round(value)}`;
                }
                if (plus) out += '+';
                return out;
            };

            const animateCount = (el, to, duration, meta) => {
                const start = 0;
                const startTime = performance.now();
                const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);
                const step = (now) => {
                    const progress = Math.min(1, (now - startTime) / duration);
                    const eased = easeOutCubic(progress);
                    const current = Math.floor(start + (to - start) * eased);
                    el.textContent = formatDisplay(current, meta);
                    if (progress < 1) requestAnimationFrame(step);
                    else {
                        // Snap to exact original-style formatting at the end
                        el.textContent = formatDisplay(to, meta);
                    }
                };
                requestAnimationFrame(step);
            };

            const rafMap = new WeakMap();

            const cancelAnim = (el) => {
                const id = rafMap.get(el);
                if (id) {
                    cancelAnimationFrame(id);
                    rafMap.delete(el);
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const footer = entry.target;
                        footer.querySelectorAll('.stat .num').forEach((numEl) => {
                            // Use original content if stored; else store it now
                            const originalText = numEl.dataset.original || numEl.textContent;
                            numEl.dataset.original = originalText.trim();
                            const meta = parseMeta(originalText);
                            // Reset display to 0 in the same style before animating
                            numEl.textContent = formatDisplay(0, meta);
                            // Cancel any ongoing animation before starting a new one
                            cancelAnim(numEl);
                            const duration = 900 + Math.random() * 400; // 0.9s - 1.3s
                            // Wrap animateCount to capture raf id
                            const animateWithTrack = () => {
                                const start = 0;
                                const startTime = performance.now();
                                const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);
                                const step = (now) => {
                                    const progress = Math.min(1, (now - startTime) / duration);
                                    const eased = easeOutCubic(progress);
                                    const current = Math.floor(start + (meta.target - start) * eased);
                                    numEl.textContent = formatDisplay(current, meta);
                                    if (progress < 1) {
                                        const id = requestAnimationFrame(step);
                                        rafMap.set(numEl, id);
                                    } else {
                                        numEl.textContent = formatDisplay(meta.target, meta);
                                        rafMap.delete(numEl);
                                    }
                                };
                                const id = requestAnimationFrame(step);
                                rafMap.set(numEl, id);
                            };
                            animateWithTrack();
                        });
                    }
                });
            }, { threshold: 0.25 });

            footers.forEach((footer) => observer.observe(footer));
        }

    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => new NestShoolini().init());
    } else {
        new NestShoolini().init();
    }
})();
