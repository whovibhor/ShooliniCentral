@extends('layouts.app')
@section('content')
  <h1 class="text-xl font-semibold mb-4">Sitemap</h1>
  <div class="rounded-xl border border-slate-200 bg-white p-6 text-slate-700">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
      <li><a class="text-sky-600 hover:underline" href="{{ route('confessions') }}">Confessions</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('marketplace') }}">Marketplace</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('events') }}">Events & Notices</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('lost-found') }}">Lost & Found</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('stayconnect') }}">StayConnect</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('carpooling') }}">Carpooling</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('about') }}">About</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('contact') }}">Contact</a></li>
      <li><a class="text-sky-600 hover:underline" href="{{ route('developer') }}">Developer</a></li>
    </ul>
  </div>
@endsection
