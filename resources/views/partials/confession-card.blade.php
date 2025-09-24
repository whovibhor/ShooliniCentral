@props([
  'id' => null,
  'alias' => 'Anonymous',
  'content' => null,
  'created' => null,
  'reactions' => 0,
])
<article
  @if($id) data-confession-id="{{ $id }}" @endif
  class="rounded-xl border border-slate-200 bg-white shadow-sm transition p-4 will-change-transform confession-card">
  <header class="mb-2 flex items-center justify-between gap-2">
    <div class="text-xs font-medium text-slate-600">{{ $alias }}</div>
    <time class="text-[11px] text-slate-400" datetime="{{ $created ?? now()->toIso8601String() }}">{{ $created ? \Carbon\Carbon::parse($created)->diffForHumans() : 'just now' }}</time>
  </header>
  <div class="prose prose-sm max-w-none text-slate-800 leading-snug whitespace-pre-line">
    {{ $content ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus, massa vitae blandit consequat, metus erat facilisis neque, non efficitur felis dui non tortor.' }}
  </div>
  <footer class="mt-3 flex items-center justify-between text-xs text-slate-500">
    <div class="flex items-center gap-3">
      <button type="button" class="confession-like inline-flex items-center gap-1 focus:outline-none transition" data-liked="false" aria-label="Like confession" data-count="{{ $reactions }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.8 10.6 19.5C5.4 15 2 12 2 8.5 2 6 4 4 6.5 4c1.7 0 3.4.8 4.5 2.1C12.1 4.8 13.8 4 15.5 4 18 4 20 6 20 8.5c0 3.5-3.4 6.5-8.6 11l-1.4 1.3Z"/></svg>
        <span class="confession-like-count">{{ $reactions }}</span>
      </button>
    </div>
    <button type="button" class="hover:text-slate-700" aria-label="More actions">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
    </button>
  </footer>
</article>
