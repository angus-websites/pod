<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\User;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

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
            $users = UserResource::collection(
                User::where("id", "!=", $user->id)->paginate(10)->withQueryString()
            );

            $featureGroups = FeatureGroupResource::collection(FeatureGroup::all());
            $features = FeatureResource::collection(Feature::all());

            // Render the admin dashboard with the data
            return Inertia::render('Admin/Dashboard', [
                "users" => $users,
                "userCount" => User::count(),
                "featureGroups" => $featureGroups,
                "features" => $features,
            ]);
        }

        // For non admins
        else{

            // Extract the features into an array
            $features = FeatureResource::collection($user->allFeatures());

            return Inertia::render('Dashboard/UserDashboard', [
                "features" => $features,
                "featureData" => Inertia::lazy(fn () => $this->getFeatureData($user))
            ]);
        }


    }

    private function getFeatureData($user): array
    {
        return [
            'entry count' => [
                "data" => number_format(count($user->entries)),
                "rank" => $user->getEntryCountRank(),
                "leaderboard" => User::entryCountLeaderboard(),
            ],
            "streak" => [
                "data" => number_format($user->streak()),
                "rank" => $user->getStreakRank(),
                "leaderboard" => User::streakLeaderboard(),
            ],
            "total word count" => [
                "data" => number_format($user->totalWordCount()),
                "rank" => $user->getTotalWordCountRank(),
                "leaderboard" => User::wordCountLeaderboard(),
            ],
        ];
    }
}
