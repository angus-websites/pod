<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\User;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

use App\Http\Resources\EntryResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\FeatureGroupResource;
use App\Http\Resources\FeatureResource;

class HomeController extends Controller
{
    /**
     * Render the dashboard view
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Render the admin dashboard
        if ($user->isAdmin()){

            // Collect data the admins need
            $users = UserResource::collection(User::all()->except($user->id));
            $featureGroups = FeatureGroupResource::collection(FeatureGroup::all());
            $features = FeatureResource::collection(Feature::all());

            // Render the admin dashboard with the data
            return Inertia::render('Admin/Dashboard', [
                "users" => $users,
                "featureGroups" => $featureGroups, 
                "features" => $features,
            ]);
        }

        // For non admins
        else{

            // Extract the features into an array
            $features = $user->getAllFeatures();

            $featureData = [
                "streak" => $user->streak(),
                "total word count" => $user->totalWordCount(),
            ];

            return Inertia::render('Dashboard/UserDashboard', ["features" => $features, "featureData" => $featureData]);
        }


    }
}
