@extends('layouts.app')
@section('content')
  <h1 class="text-xl font-semibold mb-4">Confessions</h1>
  <div id="confession-feed" class="confession-grid" data-page="1">
    @include('partials.confession-card', ['id'=>1,'alias'=>'AnonOx','content'=>'Feeling overwhelmed with assignments but also excited. Is this normal?','reactions'=>5])
    @include('partials.confession-card', ['id'=>2,'alias'=>'HiddenSoul','content'=>'Sometimes the library silence is the loudest noise.','reactions'=>2])
    @include('partials.confession-card', ['id'=>3,'alias'=>'QuietWave','content'=>str_repeat('I miss home. ', 8),'reactions'=>9])
    @include('partials.confession-card', ['id'=>4,'alias'=>'NightOwl','content'=>'Pulled an all-nighter and honestly the sunrise made it worth it.','reactions'=>4])
    @include('partials.confession-card', ['id'=>5,'alias'=>'LostAndLearning','content'=>str_repeat('Not sure what I am doing but I keep moving. ', 4),'reactions'=>7])
    @include('partials.confession-card', ['id'=>6,'alias'=>'SilentStorm','content'=>'Why does coffee taste better during finals week?','reactions'=>3])
    @include('partials.confession-card', ['id'=>7,'alias'=>'CloudMind','content'=>str_repeat('Need a break. ', 10),'reactions'=>1])
    @include('partials.confession-card', ['id'=>8,'alias'=>'LonePixel','content'=>'Saw someone help a stranger carry notes today. Faith in people restored a bit.','reactions'=>4])
    @include('partials.confession-card', ['id'=>9,'alias'=>'Afterglow','content'=>str_repeat('Wish I had started earlier. ', 5),'reactions'=>6])
    @include('partials.confession-card', ['id'=>10,'alias'=>'SilentFocus','content'=>'Library desk + lo-fi + rain outside = productivity cheat code.','reactions'=>3])
    @include('partials.confession-card', ['id'=>11,'alias'=>'StaticMind','content'=>str_repeat('Need clarity. ', 12),'reactions'=>2])
    @include('partials.confession-card', ['id'=>12,'alias'=>'BlurEdge','content'=>'Accidentally answered a rhetorical question aloud. Entire hall stared.','reactions'=>8])
    @include('partials.confession-card', ['id'=>13,'alias'=>'PaperLeaf','content'=>'Group project member actually delivered on time today. Shocked.','reactions'=>5])
    @include('partials.confession-card', ['id'=>14,'alias'=>'CrimsonField','content'=>str_repeat('Exam anxiety is real. ', 7),'reactions'=>11])
    @include('partials.confession-card', ['id'=>15,'alias'=>'EchoDust','content'=>'I want to build something meaningful but don\'t know where to start.','reactions'=>4])
    @include('partials.confession-card', ['id'=>16,'alias'=>'HollowTrace','content'=>'Forgot my presentation drive. Improvised everything. It weirdly worked.','reactions'=>6])
    @include('partials.confession-card', ['id'=>17,'alias'=>'SoftStatic','content'=>str_repeat('Trying to slow down. ', 6),'reactions'=>2])
    @include('partials.confession-card', ['id'=>18,'alias'=>'EchoPhase','content'=>'Every time I plan a break, something new pops up.','reactions'=>3])
    @include('partials.confession-card', ['id'=>19,'alias'=>'DustScript','content'=>'Accidentally pushed debug logs to repo. Regret.','reactions'=>5])
    @include('partials.confession-card', ['id'=>20,'alias'=>'LateBuffer','content'=>'Deadline extension feels like a second chance every time.','reactions'=>4])
    @include('partials.confession-card', ['id'=>21,'alias'=>'SilentRoute','content'=>'Walked across campus just to clear my head. Helped.','reactions'=>2])
    @include('partials.confession-card', ['id'=>22,'alias'=>'FaintSignal','content'=>'I learn more from explaining to friends than lectures sometimes.','reactions'=>6])
    @include('partials.confession-card', ['id'=>23,'alias'=>'ByteBloom','content'=>'Just discovered a new café corner — instant favorite.','reactions'=>4])
    @include('partials.confession-card', ['id'=>24,'alias'=>'MonoTrail','content'=>'Stared at the same paragraph for 15 minutes. Brain buffering.','reactions'=>3])
    @include('partials.confession-card', ['id'=>25,'alias'=>'SoftGlow','content'=>'Finally had a day with zero notifications. Felt unreal.','reactions'=>7])
  </div>
  <div class="mt-12 flex items-center gap-3 text-sm text-slate-500 confession-brew-note justify-center">
    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600">
      <!-- fun kettle / tea bag style icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10h13v8a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-8Z"/><path d="M16 10h1a4 4 0 0 1 0 8h-1"/><path d="M8 2v2"/><path d="M12 2v2"/><path d="M16 2v2"/></svg>
    </span>
    <span class="font-medium">More tea is brewing… sip slowly</span>
  </div>
@endsection
