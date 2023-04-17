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

        // Present features
        $leaderboardId = Feature::where("name", "=", "leaderboard")->firstOrFail()->id;
        $totalWordCountId = Feature::where("name", "=", "total word count")->firstOrFail()->id;
        $streakId = Feature::where("name", "=", "streaks")->firstOrFail()->id;


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
                "feature_id" =>  [$leaderboardId]
            ],
        ]);

        FeedbackQuestion::create([
            "name" => "QL&S",
            "feedback_group_id" => $features->id,
            "question_type" => "text",
            "required" => true,
            "targeted" => true,
            "data" => [
                "operator" => "all",
                "feature_id" =>  [$leaderboardId, $streakId]
            ],
        ]);

        FeedbackQuestion::create([
            "name" => "QLOrR",
            "feedback_group_id" => $features->id,
            "question_type" => "text",
            "required" => true,
            "targeted" => true,
            "data" => [
                "operator" => "any",
                "feature_id" =>  [$leaderboardId, $totalWordCountId]
            ],
        ]);

    }
}
