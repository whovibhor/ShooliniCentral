import './bootstrap';

// Confessions masonry + infinite scroll (progressive enhancement)
document.addEventListener('DOMContentLoaded', () => {
    const feed = document.getElementById('confession-feed');
    if (!feed) return;

    // We generate mock cards when approaching bottom
    // Static feed (25 items) – no infinite scroll.

    // Helper to create a card element (mirrors Blade partial structure)
    function makeMockCard(id) {
        const phrases = [
            'Need coffee and clarity.',
            'Can’t believe I actually enjoyed today\'s lecture.',
            'Homesick but growing.',
            'Why is group work so draining?',
            'Small wins are still wins.',
            'Trying to balance everything at once.'
        ];
        const content = Array.from({ length: Math.ceil(Math.random() * 3) }, () => phrases[Math.floor(Math.random() * phrases.length)]).join(' ');
        const wrap = document.createElement('article');
        wrap.className = 'break-inside-avoid mb-4 rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-shadow p-4 will-change-transform confession-card';
        wrap.setAttribute('data-confession-id', id);
        wrap.innerHTML = `
			<header class="mb-2 flex items-center justify-between gap-2">
				<div class="text-xs font-medium text-slate-600">Anon${id}</div>
				<time class="text-[11px] text-slate-400" datetime="${new Date().toISOString()}">just now</time>
			</header>
			<div class="prose prose-sm max-w-none text-slate-800 leading-snug whitespace-pre-line">${content}</div>
			<footer class="mt-3 flex items-center justify-between text-xs text-slate-500">
				<div class="flex items-center gap-3">
					<button type="button" class="inline-flex items-center gap-1 hover:text-slate-700 focus:outline-none" aria-label="React to confession">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.8 10.6 19.5C5.4 15 2 12 2 8.5 2 6 4 4 6.5 4c1.7 0 3.4.8 4.5 2.1C12.1 4.8 13.8 4 15.5 4 18 4 20 6 20 8.5c0 3.5-3.4 6.5-8.6 11l-1.4 1.3Z"/></svg>
						<span>${Math.floor(Math.random() * 10)}</span>
					</button>
				</div>
				<button type="button" class="hover:text-slate-700" aria-label="More actions">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
				</button>
			</footer>`;
        return wrap;
    }

    // Like button delegation
    feed.addEventListener('click', (e) => {
        const btn = e.target.closest('.confession-like');
        if (!btn || !feed.contains(btn)) return;
        const countSpan = btn.querySelector('.confession-like-count');
        const liked = btn.getAttribute('data-liked') === 'true';
        let count = parseInt(btn.getAttribute('data-count') || '0', 10);
        if (liked) {
            count = Math.max(0, count - 1);
            btn.setAttribute('data-liked', 'false');
        } else {
            count = count + 1;
            btn.setAttribute('data-liked', 'true');
        }
        btn.setAttribute('data-count', count.toString());
        if (countSpan) countSpan.textContent = count.toString();
    });

    // Replace legacy dynamic mock generation artifacts on future refactor.
});
