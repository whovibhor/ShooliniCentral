(function () {
    const sidebar = document.getElementById('sidebar');
    const app = document.getElementById('app');
    const toggle = document.getElementById('sidebarToggle');
    const STORAGE_KEY = 'sc.sidebar.collapsed';

    function setCollapsed(value) {
        if (!sidebar) return;
        sidebar.setAttribute('data-collapsed', String(!!value));
        localStorage.setItem(STORAGE_KEY, String(!!value));
        if (toggle) toggle.setAttribute('aria-expanded', String(!value));
        // Also toggle a class on the app container so the grid can resize
        if (app) {
            app.classList.toggle('sidebar-collapsed', !!value);
        }
    }

    // init from storage
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved !== null) {
        setCollapsed(saved === 'true');
    } else {
        // reflect current DOM attribute on first load
        const isCollapsed = sidebar?.getAttribute('data-collapsed') === 'true';
        if (isCollapsed) {
            setCollapsed(true);
        }
    }

    if (toggle) {
        toggle.addEventListener('click', () => setCollapsed(sidebar?.getAttribute('data-collapsed') !== 'true' ? true : false));
    }

    // Active link highlight by path
    const current = location.pathname.replace(/\/$/, '');
    document.querySelectorAll('.sidebar .nav-item').forEach((a) => {
        try {
            const href = a.getAttribute('href') || '';
            const norm = href.replace(/\/$/, '');
            if (norm && norm !== '#' && current.startsWith(norm)) {
                a.classList.add('active');
            }
        } catch (e) {/* noop */ }
    });

    // Keyboard: toggle with Ctrl+\
    window.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === '\\') {
            e.preventDefault();
            const isCollapsed = sidebar?.getAttribute('data-collapsed') === 'true';
            setCollapsed(!isCollapsed);
        }
    });
})();
