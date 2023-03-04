<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    /**
     * Show the form for submitting feedback
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Features/Feedback');
    }
}
