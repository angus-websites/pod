<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use App\Http\Resources\Feedback\FeedbackGroupResource;
use App\Http\Resources\Feedback\FeedbackQuestionResource;
use App\Http\Resources\Feedback\FeedbackReviewGroupResource;
use App\Models\FeedbackQuestion;
use App\Models\FeedbackGroup;
use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        // Get all the feedback groups to display
        $feedbackGroups = FeedbackGroupResource::collection(
            FeedbackGroup::all()->sortBy("position")
        );


        return Inertia::render('Feedback/Index',
            [
                "feedbackGroups"=>$feedbackGroups,
            ]
        );
    }

    /**
     * Handles submitted forms
     * @throws ValidationException
     */
    public function submit(Request $request)
    {
        // Check permissions before processing feedback
        if (! Gate::allows('access-feedback', Auth::user())) {
            abort(403);
        }

        // Ensure we receive some content
        if($request->has('feedback')){

            $userID = Auth::user()->id;

            // Generate a UID for this submission
            $uuid = Str::uuid()->toString();

            // Extract our content
            $content = $request->feedback["answers"];

            // Add the relevant data to the request, user_id, answer etc
            $feedbackData = [];
            foreach ($content as $question => $answer) {

                // Create a custom validator (limit each answer to 600 characters)
                Validator::make(
                    [$question => $answer],
                    [$question => 'max:600'],
                    [$question => "Your answer is too long (max 600 characters)"]
                )->validate();

                // If there was no answer, don't save to database
                if ($answer) {
                    $feedbackData[] = [
                        "feedback_question_id" => $question,
                        "user_id" => $userID,
                        "feedback_batch" => $uuid,
                        "answer" => $answer,
                    ];
                }
            }

            // Only insert if we have at least one bit of valid data
            if (count($feedbackData) > 0){
                // Save all to the user-feedback table
                UserFeedback::insert($feedbackData);
            }else{
                return Redirect::back()->with('error', 'Nothing submitted');
            }


        }else{
            abort(400, "Missing feedback data");
        }

        return Redirect::back()->with('success', 'Form submitted');


    }

    /**
     * Allow the feedback to be reviewed
     */
    public function review()
    {
        // Check permissions before rendering feedback form
        if (! Gate::allows('review-feedback', Auth::user())) {
            abort(403);
        }

        // Fetch all the user feedback
        $feedback = FeedbackReviewGroupResource::collection(
            FeedbackGroup::all()
        );

        return Inertia::render('Feedback/Review',
            ["feedback" => $feedback]
        );

    }
}
