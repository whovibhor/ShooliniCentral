@php
  // Determine active state using route name when provided; otherwise, compare current URL to href
  if (isset($route) && $route) {
    $isActive = request()->routeIs($route) || request()->routeIs($route . '.*');
  } else {
    $isActive = url()->current() === ($href ?? '#');
  }
  // Use explicit PNG icon variants for default (bw) and hover/active (col)
  $hasPng = isset($iconPngBw) && isset($iconPngCol);
  // Compose container classes: remove inner grey background/border, keep stable 40x40 box
  $containerBase = 'inline-flex w-10 h-10 min-w-10 items-center justify-center rounded-md relative overflow-hidden navicon leading-none shrink-0';
  $containerState = '';
@endphp
<a href="{{ $href ?? '#' }}" class="group flex items-center gap-4 px-3 py-2.5 mx-2 rounded-md hover:bg-slate-100 transition relative {{ $isActive ? 'bg-slate-100' : '' }}" title="{{ $label }}" @if($isActive) aria-current="page" @endif>
  <span class="{{ $containerBase }}{{ $containerState }}">
    @if($hasPng)
      {{-- Two stacked PNGs: bw (default) and col (hover/active) --}}
  <img src="{{ asset($iconPngBw) }}" alt="" role="presentation" class="icon-bw absolute w-8 h-8 object-contain select-none pointer-events-none" />
  <img src="{{ asset($iconPngCol) }}" alt="" role="presentation" class="icon-col absolute w-8 h-8 object-contain select-none pointer-events-none opacity-0" />
    @else
      {{-- simple icons using lucide classes via inline SVGs; placeholder circles for now --}}
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
        <circle cx="12" cy="12" r="9" />
      </svg>
    @endif
  </span>
  <span class="label text-sm text-slate-800 whitespace-nowrap">{{ $label ?? 'Item' }}</span>
  {{-- Removed left red border indicator for active item as requested --}}
</a>
