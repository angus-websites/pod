<?php

namespace Database\Seeders\core;

use App\Models\FeedbackGroup;
use App\Models\FeedbackQuestion;
use App\Models\UserFeedback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Clear data
        FeedbackGroup::truncate();
        FeedbackQuestion::truncate();
        UserFeedback::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Groups
        $general = FeedbackGroup::create([
            "name" => "General",
            "caption" => "Some general questions about the app",
            "position" => 0,
        ]);

        $features = FeedbackGroup::create([
            "name" => "Features",
            "caption" => "Specific questions about the apps features",
            "position" => 1,
        ]);


        // Create some questions
        FeedbackQuestion::create([
            "name" => "What do you think about this website?",
            "feedback_group_id" => $general->id,
            "question_type" => "text",
            "data" => [],
        ]);

        FeedbackQuestion::create([
            "name" => "Which feature is your favourite?",
            "feedback_group_id" => $features->id,
            "question_type" => "radio",
            "data" => [
                "options" => [
                    ["label" => "Leaderboard", "id" => "leaderboard"],
                    ["label" => "Streaks", "id" => "streaks"],
                    ["label" => "Total word count", "id" => "twc"],
                ]
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "Second favourite?",
            "feedback_group_id" => $features->id,
            "question_type" => "radio",
            "data" => [
                "options" => [
                    ["label" => "Leaderboard", "id" => "leaderboard"],
                    ["label" => "Streaks", "id" => "streaks"],
                    ["label" => "Total word count", "id" => "twc"],
                ]
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "Did the leaderboard encourage you to use the application more?",
            "feedback_group_id" => $features->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => [
                    ["label" => "Yes", "id" => "yes"],
                    ["label" => "No", "id" => "no"],
                ],
                "feature_id" => Feature::where("name", "=", "leaderboard")->firstOrFail()->id

            ]
        ]);




    }
}
