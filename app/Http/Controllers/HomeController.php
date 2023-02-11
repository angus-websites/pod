<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\EntryCollection;

class HomeController extends Controller
{
    /**
     * Render the dashboard view
     */
    public function dashboard()
    {
        // Render the admin dashboard
        if (Auth::user()->isAdmin()){
            return Inertia::render('Admin/Dashboard');
        }
        // Render the normal user dashboard
        else{
            $entries =  new EntryCollection(Auth::user()->entries()->paginate(15));
            return Inertia::render('Dashboard', ["entries" => $entries]);
        }

        
    }
}
