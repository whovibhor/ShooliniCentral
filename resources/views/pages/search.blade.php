@extends('layouts.app')
@section('content')
  <h1 class="text-xl font-semibold mb-4">Search</h1>
  <div class="rounded-xl border border-slate-200 bg-white p-6 text-slate-700">
    @php $q = request('q'); @endphp
    @if($q)
      <p class="mb-2">Showing results for: <span class="font-medium">{{ $q }}</span></p>
    @else
      <p class="mb-2">Type your query in the search box to find content.</p>
    @endif
    <p class="text-slate-500">Search integration coming soon…</p>
  </div>
@endsection
