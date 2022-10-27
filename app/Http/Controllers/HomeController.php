<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Render the dashboard view
     */
    public function dashboard()
    {
        $user = Auth::user();
        return Inertia::render('Dashboard', ["entries" => Auth::user()->entries()->get()]);
    }
}
