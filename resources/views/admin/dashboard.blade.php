@extends('layouts.app')

@section('title', 'Admin Dashboard • NEST Shoolini')

@section('head')
<style>
.admin-wrap{min-height:calc(100vh - 80px);padding:24px 24px}
@media(min-width:768px){.admin-wrap{padding:32px 48px}}
.admin-head{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:20px}
.admin-title{font-size:28px;font-weight:800;color:#fff}
.admin-grid{display:grid;grid-template-columns:repeat(2, minmax(0,1fr));gap:20px}
@media(max-width:575.98px){.admin-grid{grid-template-columns:1fr}}
.card{border:1px solid var(--glass-border);border-radius:14px;background:var(--glass-bg);padding:18px;transition:transform .18s ease, box-shadow .18s ease}
.card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(0,0,0,.35)}
.card h3{margin:0 0 6px;color:#fff}
.card p{margin:0;color:#c7c7c7}
.card .actions{margin-top:12px}
.btn{display:inline-block;padding:10px 12px;border-radius:10px;border:1px solid var(--glass-border);background:#dc2626;color:#fff;text-decoration:none}
</style>
@endsection

@section('content')
<div class="admin-wrap">
  <div class="admin-head">
    <h1 class="admin-title">Admin Dashboard</h1>
    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn" type="submit">Logout</button></form>
  </div>

  <div class="admin-grid">
    <div class="card">
      <h3>Manage Marketplace</h3>
      <p>Review and moderate listings, handle reports.</p>
      <div class="actions"><a class="btn" href="#">Open</a></div>
    </div>
    <div class="card">
      <h3>Manage Confessions</h3>
      <p>Moderate posts and reactions, resolve reports.</p>
      <div class="actions"><a class="btn" href="#">Open</a></div>
    </div>
  </div>
</div>
@endsection
