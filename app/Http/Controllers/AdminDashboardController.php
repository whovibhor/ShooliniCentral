<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // basic gate: ensure admin
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);
        return view('admin.dashboard');
    }
}
