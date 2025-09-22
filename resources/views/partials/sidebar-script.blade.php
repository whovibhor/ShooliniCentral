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

    toggleBtn?.addEventListener('click', () => {
      set(current() === 'collapsed' ? 'expanded' : 'collapsed');
    });

    window.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && (e.key.toLowerCase() === 'b')) {
        e.preventDefault();
        toggleBtn?.click();
      }
    });
  })();
</script>
