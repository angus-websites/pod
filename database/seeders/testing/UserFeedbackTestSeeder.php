<?php

namespace Database\Seeders\testing;

use App\Models\FeedbackGroup;
use App\Models\FeedbackQuestion;
use App\Models\User;
use App\Models\UserFeedback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

//Models

class UserFeedbackTestSeeder extends Seeder
{
    /**
     * Generating some user feedback
     */
    public function run()
    {

        // --------------- Create some Questions -------------

        $general = FeedbackGroup::create([
            "name" => "General",
            "caption" => "General questions",
            "position" => 0,
        ]);

        // Create some questions
        $q1= FeedbackQuestion::create([
            "name" => "Q1",
            "feedback_group_id" => $general->id,
            "question_type" => "text",
        ]);

        $q2= FeedbackQuestion::create([
            "name" => "Q2",
            "feedback_group_id" => $general->id,
            "question_type" => "text",
        ]);

        // --------------- Create some users -----------------

        $user1 = User::create([
            'name' => "User1",
            'email' => "User1@gmail.com",
            'password' => Hash::make("password"),
        ]);

        $user2 = User::create([
            'name' => "User2",
            'email' => "Use21@gmail.com",
            'password' => Hash::make("password"),
        ]);

        // --------------- Create some Feedback -------------

        UserFeedback::create([
            "feedback_question_id" => $q1->id,
            "user_id" => $user1->id,
            "answer" => "My answer for question 1"
        ]);

        UserFeedback::create([
            "feedback_question_id" => $q1->id,
            "user_id" => $user2->id,
            "answer" => "Another answer for question 1"
        ]);

        UserFeedback::create([
            "feedback_question_id" => $q2->id,
            "user_id" => $user1->id,
            "answer" => "A slightly different answer for a different question"
        ]);

        UserFeedback::create([
            "feedback_question_id" => $q2->id,
            "user_id" => $user2->id,
            "answer" => "A completely different answer again"
        ]);





    }
}
