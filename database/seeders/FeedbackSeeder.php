<?php

namespace Database\Seeders;

use App\Models\FeedbackQuestion;
use App\Models\FeedbackQuestionGroup;
use App\Models\UserFeedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        FeedbackQuestionGroup::truncate();
        FeedbackQuestion::truncate();
        UserFeedback::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Groups
        $general = FeedbackQuestionGroup::create([
            "name" => "General",
            "caption" => "Some general questions about the app",
            "position" => 0,
        ]);

        $features = FeedbackQuestionGroup::create([
            "name" => "Features",
            "caption" => "Specific questions about the apps features",
            "position" => 1,
        ]);


        // Create some questions
        FeedbackQuestion::create([
            "name" => "What do you think about this website?",
            "feedback_question_group_id" => $general->id,
            "question_type" => "text",
            "data" => [],
        ]);

        FeedbackQuestion::create([
            "name" => "Which feature is your favourite?",
            "feedback_question_group_id" => $features->id,
            "question_type" => "radio",
            "data" => [
                "options" => [
                    "Leaderboard",
                    "Streaks",
                    "Total word count"
                ]
            ]
        ]);




    }
}
