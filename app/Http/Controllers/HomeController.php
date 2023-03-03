<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\User;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

use App\Http\Resources\EntryResource;
use App\Http\Resources\UserResource;

class HomeController extends Controller
{
    /**
     * Render the dashboard view
     */
    public function dashboard()
    {
        
        // Render the admin dashboard
        if (Auth::user()->isAdmin()){
            $users = UserResource::collection(User::all()->except(Auth::id()));
            return Inertia::render('Admin/Dashboard', ["users" => $users]);
        }
        // Render the normal user dashboard
        else{
            $entries = EntryResource::collection(Auth::user()->entries()->paginate(15));

            // Check for feature access
            if (Auth::user()->groupHasFeature('Use streaks')){
                return Inertia::render('Features/StreaksDashboard', ["entries" => $entries]);
            } 
            return Inertia::render('Dashboard', ["entries" => $entries]);
        }

        
    }
}
