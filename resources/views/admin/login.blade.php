@extends('layouts.app')

@section('title', 'Admin Login • NEST Shoolini')

@section('head')
<style>
.auth-wrapper{min-height:calc(100vh - 80px);display:flex;align-items:center;justify-content:center;padding:24px}
.auth-card{max-width:460px;width:100%;padding:24px;border:1px solid var(--glass-border);border-radius:16px;background:var(--glass-bg)}
.auth-card h1{margin:0 0 8px;color:#fff;font-weight:800;font-size:24px}
.auth-card p{margin:0 0 20px;color:#a1a1aa}
.form-row{display:flex;flex-direction:column;gap:8px;margin-bottom:14px}
.form-row label{color:#d4d4d8;font-size:14px}
.form-row input{background:#0d0d0d;border:1px solid var(--glass-border);border-radius:10px;padding:12px 14px;color:#fff}
.form-actions{display:flex;align-items:center;justify-content:space-between;margin-top:8px}
.btn{display:inline-block;padding:10px 14px;border-radius:10px;border:1px solid var(--glass-border);background:#dc2626;color:#fff;text-decoration:none}
.link{color:#aaa}
.error{color:#fca5a5;font-size:13px}
</style>
@endsection

@section('content')
<div class="auth-wrapper">
  <form method="POST" action="{{ route('admin.login.post') }}" class="auth-card" novalidate>
    @csrf
    <h1>Admin Login</h1>
    <p>Sign in with your admin credentials.</p>

    <div class="form-row">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
      @error('email')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-row">
      <label for="password">Password</label>
      <input id="password" name="password" type="password" required autocomplete="current-password">
      @error('password')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-actions">
      <label style="display:flex;align-items:center;gap:8px;color:#c7c7c7;font-size:14px">
        <input type="checkbox" name="remember" value="1"> Remember me
      </label>
      <button type="submit" class="btn">Sign in</button>
    </div>
  </form>
  </div>
@endsection
