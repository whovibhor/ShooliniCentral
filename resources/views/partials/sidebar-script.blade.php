<script>
  (() => {
    const sidebar = document.getElementById('sc-sidebar');
    const main = document.getElementById('sc-main');
    const toggleBtn = document.getElementById('sc-sidebar-toggle');
    const EXPANDED = 240;
    const COLLAPSED = 72;
    const storageKey = 'sc:sidebar:collapsed';

    function apply(state) {
      const collapsed = state === 'collapsed';
      sidebar.style.width = (collapsed ? COLLAPSED : EXPANDED) + 'px';
      document.documentElement.dataset.sidebar = collapsed ? 'collapsed' : 'expanded';
      // hide/show labels via data attr in CSS if desired
    }

    function current() {
      return (localStorage.getItem(storageKey) === '1') ? 'collapsed' : 'expanded';
    }

    function set(state) {
      localStorage.setItem(storageKey, state === 'collapsed' ? '1' : '0');
      apply(state);
    }

    // init
    apply(current());

    // FLIP animation for confession cards when column count changes (sidebar toggle)
    let flipLock = false;
    function animateReflow() {
      if (flipLock) return; // prevent overlapping toggles
      flipLock = true;
      const feed = document.getElementById('confession-feed');
      if (!feed) return;
      const cards = Array.from(feed.querySelectorAll('.confession-card'));
      // First: record initial positions
      const firstRects = cards.map(el => el.getBoundingClientRect());
      // Force style change (toggle will update data attr & column-count via CSS)
      requestAnimationFrame(() => {
        const lastRects = cards.map(el => el.getBoundingClientRect());
        cards.forEach((el,i) => {
          const first = firstRects[i];
          const last = lastRects[i];
          const dx = first.left - last.left;
          const dy = first.top - last.top;
          if (dx || dy) {
            const existingScale = getComputedStyle(el).transform.includes('matrix') ? '' : '';
            el.style.willChange = 'transform';
            el.style.transform = `translate(${dx}px, ${dy}px)`;
            el.style.transition = 'none';
            // next frame: play to natural position
            requestAnimationFrame(() => {
              el.style.transform = '';
              el.style.transition = 'transform 360ms cubic-bezier(.16,.84,.44,1), box-shadow 160ms';
            });
          }
        });
        // release lock after animation window
        setTimeout(() => { flipLock = false; cards.forEach(c=>c.style.willChange=''); }, 420);
      });
    }

    toggleBtn?.addEventListener('click', () => {
      const nextState = current() === 'collapsed' ? 'expanded' : 'collapsed';
      // capture before layout
      animateReflow();
      set(nextState);
    });

    window.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && (e.key.toLowerCase() === 'b')) {
        e.preventDefault();
        toggleBtn?.click();
      }
    });
  })();
</script>
