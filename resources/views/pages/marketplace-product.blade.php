@extends('layouts.app')

@section('title', 'Marketplace • Product')

@section('head')
<style>
:root{
  --mp-bg:#0b0f14;--mp-bg-elev:#111720;--mp-bg-hover:#121a26;--mp-card:#0f1620;--mp-card-2:#0c121a;
  --mp-fg:#e6edf3;--mp-fg-secondary:#93a3b3;--mp-border:#1e2a3a;--mp-accent:#ef4444;--mp-accent-2:#7f1d1d;
  --mp-glow: 0 0 0 rgba(239,68,68,0);
}
.product-page{--shell-pad:24px; padding:var(--shell-pad); max-width:1200px; margin:0 auto}
.breadcrumbs{display:flex;gap:8px;align-items:center;color:var(--mp-fg-secondary);font-size:.9rem}
.breadcrumbs a{color:var(--mp-fg-secondary);text-decoration:none}
.breadcrumbs a:hover{color:var(--mp-fg)}
.product-wrap{display:grid;grid-template-columns: 1.1fr .9fr; gap:24px; margin-top:16px}
.gallery{background:linear-gradient(180deg,var(--mp-card),transparent 30%) padding-box, radial-gradient(120% 100% at 0% 0%, rgba(239,68,68,.12), transparent 40%) border-box; border:1px solid var(--mp-border); border-radius:14px; padding:16px}
.gallery-main{aspect-ratio: 5/4; background:var(--mp-card-2); border-radius:12px; overflow:hidden; display:grid; place-items:center}
.gallery-main img{width:100%; height:100%; object-fit:cover; transition: transform .5s}
.thumbs{display:flex; gap:10px; margin-top:12px; overflow:auto; padding-bottom:4px}
.thumbs img{width:72px; height:72px; object-fit:cover; border-radius:10px; border:1px solid var(--mp-border); opacity:.9; cursor:pointer}
.thumbs img:hover{opacity:1; border-color:var(--mp-accent)}
.summary{background:linear-gradient(180deg,var(--mp-card),transparent 30%) padding-box, radial-gradient(120% 100% at 100% 0%, rgba(239,68,68,.12), transparent 40%) border-box; border:1px solid var(--mp-border); border-radius:14px; padding:20px}
.summary h1{font-size:1.5rem; margin:0 0 6px}
.price{font-size:1.6rem; color:#fde68a; font-weight:700}
.sub{color:var(--mp-fg-secondary); font-size:.95rem}
.pill{display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border:1px solid var(--mp-border); border-radius:999px; background:rgba(255,255,255,.02); color:var(--mp-fg-secondary); font-size:.85rem}
.act-row{display:flex; gap:10px; margin:14px 0}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 14px;border-radius:10px;border:1px solid var(--mp-border);background:linear-gradient(180deg,#19202a,#121821);color:var(--mp-fg);font-weight:600;box-shadow:var(--mp-glow);transition:all .25s ease}
.btn:hover{transform:translateY(-1px);box-shadow:0 0 0 2px rgba(239,68,68,.15);border-color:#2a3a50}
.btn.primary{background:linear-gradient(180deg, #991b1b, #7f1d1d);border-color:#ef4444;box-shadow:0 10px 30px -12px rgba(239,68,68,.4)}
.btn.primary:hover{filter:brightness(1.05)}
.btn.ghost{background:transparent}
.kv{display:grid;grid-template-columns:1fr 1fr; gap:10px}
.kv div{background:rgba(255,255,255,.02); border:1px solid var(--mp-border); border-radius:10px; padding:10px; display:flex; justify-content:space-between; color:var(--mp-fg-secondary)}
.sections{display:grid; grid-template-columns: 1fr; gap:16px; margin-top:16px}
.panel{background:linear-gradient(180deg,var(--mp-card),transparent 30%) padding-box; border:1px solid var(--mp-border); border-radius:14px; padding:16px}
.panel h3{margin:0 0 10px; font-size:1.05rem}
.specs{display:grid; grid-template-columns:1fr 2fr; gap:8px; color:var(--mp-fg-secondary)}
.stars{color:#fbbf24}
.review{border-top:1px solid var(--mp-border); padding-top:12px; margin-top:12px}

@media (max-width: 1024px){.product-wrap{grid-template-columns:1fr}}
</style>
@endsection

@section('content')
@php
  $title = ucwords(str_replace('-', ' ', $slug ?? 'product'));
  $seed = preg_replace('/.*-([a-z0-9]+)$/','${1}', $slug ?? 'img1');
@endphp

<main class="product-page">
  <nav class="breadcrumbs" aria-label="Breadcrumb">
    <a href="{{ url('/marketplace') }}">Marketplace</a>
    <span>/</span>
    <span aria-current="page">{{ $title }}</span>
  </nav>

  <div class="product-wrap">
    <section class="gallery">
      <div class="gallery-main">
        <img src="https://picsum.photos/seed/{{ $seed }}/900/700" alt="{{ $title }}" id="mainImg">
      </div>
      <div class="thumbs" id="thumbs">
        @foreach([1,2,3,4,5] as $i)
          <img src="https://picsum.photos/seed/{{ $seed }}{{ $i }}/200/200" alt="{{ $title }} thumbnail {{ $i }}" onclick="document.getElementById('mainImg').src=this.src.replace('/200/200','/900/700')">
        @endforeach
      </div>
    </section>

    <aside class="summary" id="buy">
      <h1>{{ $title }}</h1>
      <div class="sub">Brand new • 7-day replacement • Free delivery</div>
      <div style="display:flex;align-items:center;gap:10px;margin-top:8px">
        <span class="price">₹ 299</span>
        <span class="pill"><span class="stars">★★★★☆</span> 4.2 • 128 reviews</span>
      </div>
      <div class="kv" style="margin-top:12px">
        <div><span>Seller</span><strong>TechDeals</strong></div>
        <div><span>Warranty</span><strong>1 Year</strong></div>
        <div><span>Delivery</span><strong>2-4 days</strong></div>
        <div><span>Return</span><strong>7 days</strong></div>
      </div>
      <div class="act-row">
        <button class="btn primary" type="button">Buy Now</button>
        <button class="btn" type="button">Add to Cart</button>
        <button class="btn ghost" type="button" aria-label="Add to wishlist">♡ Wishlist</button>
      </div>
      <div class="sub">Secure payment • COD available • Price inclusive of taxes</div>
    </aside>
  </div>

  <div class="sections">
    <section class="panel">
      <h3>Product Description</h3>
      <p style="margin:0;color:var(--mp-fg-secondary)">Experience the next‑gen performance with premium materials, long‑lasting battery, and seamless connectivity. Designed for students and professionals who value style and substance.</p>
    </section>

    <section class="panel">
      <h3>Specifications</h3>
      <div class="specs">
        <div>Material</div><div>Aluminium Alloy + Gorilla Glass</div>
        <div>Compatibility</div><div>iOS, Android, Windows</div>
        <div>Connectivity</div><div>Bluetooth 5.3, Wi‑Fi 6</div>
        <div>Battery</div><div>Up to 7 days typical use</div>
      </div>
    </section>

    <section class="panel">
      <h3>Ratings & Reviews</h3>
      <div class="review">
        <div class="stars">★★★★★</div>
        <div style="color:var(--mp-fg-secondary)">Amazing quality for the price. Delivery was fast and packaging was neat.</div>
      </div>
      <div class="review">
        <div class="stars">★★★★☆</div>
        <div style="color:var(--mp-fg-secondary)">Battery life is decent. Looks premium.</div>
      </div>
    </section>
  </div>
</main>

<script>
  // tiny UX: zoom on hover for main image
  (function(){
    const img=document.getElementById('mainImg');
    if(!img) return; img.addEventListener('mouseenter',()=>img.style.transform='scale(1.03)');
    img.addEventListener('mouseleave',()=>img.style.transform='');
  })();
</script>
@endsection
