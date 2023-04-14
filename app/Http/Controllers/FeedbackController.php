<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Show the form for submitting feedback
     *
     * @return \Inertia\Response
     */
    public function index()
    {

        // Check permissions before rendering feedback form
        if (! Gate::allows('access-feedback', Auth::user())) {
            abort(403);
        }

        // Get all the features this user has access to
        $features = FeatureResource::collection(Auth::user()->allFeatures());

        return Inertia::render('Feedback/Index', ["features"=>$features]);
    }
}
