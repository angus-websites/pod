<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CVController extends Controller
{
    /**
     * Show the CV builder page
     *
     * @return \Inertia\Response
     */
    public function index()
    {

        // Check permissions before rendering feedback form
        if (! Gate::allows('access-cv', Auth::user())) {
            abort(403);
        }

        return Inertia::render('CV/Index');
    }
}
