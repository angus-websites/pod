<?php

namespace Database\Seeders\testing;

use App\Models\FeedbackGroup;
use App\Models\FeedbackQuestion;
use Illuminate\Database\Seeder;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

//Models

class FeedbackTestSeeder extends Seeder
{
    /**
     * Generating test data
     * for the feedback tests
     */
    public function run()
    {

        $features = FeedbackGroup::create([
            "name" => "Features",
            "caption" => "Specific questions about the apps features",
            "position" => 1,
        ]);

        // Create some questions
        FeedbackQuestion::create([
            "name" => "Q1",
            "feedback_group_id" => $features->id,
            "question_type" => "text",
            "required" => true,
            "targeted" => true,
            "data" => [
                "feature_id" =>  Feature::where("name", "=", "leaderboard")->firstOrFail()->id
            ],
        ]);

    }
}
