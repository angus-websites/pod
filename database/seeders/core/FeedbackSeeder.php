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

        // Reusable option arrays
        $satsifactionOptions = [
            ["label" => "Extremely satisfied", "id" => "extremely"],
            ["label" => "Very satisfied", "id" => "very"],
            ["label" => "Somewhat satisfied", "id" => "somewhat"],
            ["label" => "Not so satisfied", "id" => "not so"],
            ["label" => "Not at all satisfied", "id" => "not at all"],
        ];

        $yesNo = [
            ["label" => "Yes", "id" => "yes"],
            ["label" => "No", "id" => "no"],
        ];

        // Reusable features
        $leaderboardId = Feature::where("name", "=", "leaderboard")->firstOrFail()->id;
        $streaksId = Feature::where("name", "=", "streaks")->firstOrFail()->id;
        $totalWordCountId = Feature::where("name", "=", "total word count")->firstOrFail()->id;
        $rankedId = Feature::where("name", "=", "ranked")->firstOrFail()->id;
        $cvId = Feature::where("name", "=", "cv builder")->firstOrFail()->id;


        // ----- Groups -----

        $general = FeedbackGroup::create([
            "name" => "General questions",
            "caption" => "Some general questions about the application",
            "position" => 0,
        ]);

        $using = FeedbackGroup::create([
            "name" => "Using the application",
            "caption" => "Please rate your level of satisfaction with the following aspects of the website",
            "position" => 1,
        ]);

        $features = FeedbackGroup::create([
            "name" => "Additional feedback",
            "caption" => "Please provide some additional feedback about the website",
            "position" => 2,
        ]);

        $last = FeedbackGroup::create([
            "name" => "Final thoughts",
            "caption" => "Do you have any final thoughts or feedback on the website?",
            "position" => 3,
        ]);

        // ------ Questions -----


        // --- General ---
        FeedbackQuestion::create([
            "name" => "Overall, how satisfied are you with the website?",
            "feedback_group_id" => $general->id,
            "question_type" => "radio",
            "data" => [
                "options" => $satsifactionOptions
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "Has this website aided you at all during your current placement?",
            "feedback_group_id" => $general->id,
            "question_type" => "radio",
            "data" => [
                "options" => $yesNo
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "If this website has aided you, in what way has it done so?",
            "feedback_group_id" => $general->id,
            "question_type" => "text",
        ]);

        // --- Using ---
        FeedbackQuestion::create([
            "name" => "How satisfied were you with the general ease of use of the website?",
            "caption" => "Eg. Navigating the site and performing tasks",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "data" => [
                "options" => $satsifactionOptions
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "How satisfied were you with the look of the website",
            "caption" => "Was the website visually appealing and laid out in a useful way?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "data" => [
                "options" => $satsifactionOptions
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "How satisfied were you with the performance of the website?",
            "caption" => "Were pages quick to load and was it a smooth experience?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "data" => [
                "options" => $satsifactionOptions
            ]
        ]);

        // --- Targeted questions ---

        // -- Leaderboard --

        FeedbackQuestion::create([
            "name" => "Did the leaderboard encourage you to use the website more?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => $yesNo,
                "feature_id" => [$leaderboardId]
            ]
        ]);

        // -- Streaks --
        FeedbackQuestion::create([
            "name" => "Did the ability to see your entry streak encourage you to use the website more?",
            "caption" => "On the dashboard you can see how many consecutive days you have written in your diary, did this encourage you to use the website more",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => $yesNo,
                "feature_id" => [$streaksId]
            ]
        ]);

        // -- Ranked --
        FeedbackQuestion::create([
            "name" => "Did the ability to see your ranking compared to other users encourage you to use the website more?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => $yesNo,
                "feature_id" => [$rankedId]
            ]
        ]);

        // -- Total word count --
        FeedbackQuestion::create([
            "name" => "Did the ability to see the total word count for your entries encourage you to use the website more?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => $yesNo,
                "feature_id" => [$totalWordCountId]
            ]
        ]);

        // -- CV builder --
        FeedbackQuestion::create([
            "name" => "Did you have a chance to use the CV builder?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => $yesNo,
                "feature_id" => [$cvId]
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "If you used the CV builder how satisfied were you with it's result?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => array_merge($satsifactionOptions, array(["label" => "NA", "id" => "na"])),
                "feature_id" => [$cvId]
            ]
        ]);

        // -- Multi targeted questions

        FeedbackQuestion::create([
            "name" => "Which of the following features encouraged you to use the application more",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => [
                    ["label" => "Viewing your total word count", "id" => "totalWordCount"],
                    ["label" => "Being able to see my current entry streak", "id" => "streak"],
                ],
                "operator" => "all",
                "feature_id" => [$totalWordCountId, $streaksId]
            ]
        ]);

        FeedbackQuestion::create([
            "name" => "When viewing the leaderboard, which statistic did you care about the most?",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => [
                    ["label" => "Number of entries", "id" => "numberOfEntries"],
                    ["label" => "Longest streak", "id" => "streak"],
                    ["label" => "Total word count", "id" => "totalWordCount"],
                    ["label" => "I didnt care about any of the leaderboard features", "id" => "didntCare"],

                ],
                "feature_id" => [$leaderboardId, $streaksId, $totalWordCountId]
            ]
        ]);


        FeedbackQuestion::create([
            "name" => "What rank did you care the most about?",
            "caption" => "On your dashboard, you can see your rank for certain statistics compared to other users, which statistic did you care the most about",
            "feedback_group_id" => $using->id,
            "question_type" => "radio",
            "targeted" => true,
            "data" => [
                "options" => [
                    ["label" => "Number of entries", "id" => "numberOfEntries"],
                    ["label" => "Longest streak", "id" => "streak"],
                    ["label" => "Total word count", "id" => "totalWordCount"],
                    ["label" => "I didnt care about any of the rankings", "id" => "didntCare"],
                ],
                "feature_id" => [$rankedId, $streaksId, $totalWordCountId]
            ]
        ]);



        // --- Last thoughts ----

        FeedbackQuestion::create([
            "name" => "Do you have any thoughts about how to improve this application?",
            "feedback_group_id" => $last->id,
            "question_type" => "text",
        ]);

        FeedbackQuestion::create([
            "name" => "Would you recommend POD to other students currently or about to take a placement year?",
            "feedback_group_id" => $last->id,
            "question_type" => "radio",
            "data" => [
                "options" => $yesNo
            ]
        ]);







    }
}
