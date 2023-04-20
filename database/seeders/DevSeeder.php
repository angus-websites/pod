<?php

namespace Database\Seeders;

use App\Models\Entry;
use App\Models\FeedbackGroup;
use App\Models\FeedbackQuestion;
use App\Models\User;
use App\Models\UserFeedback;
use Database\Seeders\core\AdminSeeder;
use Database\Seeders\core\FeatureSeeder;
use Database\Seeders\core\FeedbackSeeder;
use Database\Seeders\core\RoleSeeder;
use Database\Seeders\core\TemplateSeeder;
use Faker\Generator;
use Illuminate\Database\Seeder;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;
use Faker\Factory as Faker;

class DevSeeder extends Seeder
{
    /**
     * For seeding a database
     * for development purposes, this
     * will create fake users and entries
     *
     * @return void
     */
    public function run()
    {

        // Create some roles for the app
        $this->call(RoleSeeder::class);

        // Create the Templates
        $this->call(TemplateSeeder::class);

        // Call FeatureSeeder
        $this->call(FeatureSeeder::class);

        // Admin seed
        $this->call(AdminSeeder::class);

        // Feedback Seeding
        $this->call(FeedbackSeeder::class);

        // Create some users with entries
        User::factory()->count(15)->create()->each(function ($u){
            // Assign a random group to this user
            $random_group_name = FeatureGroup::all()->where("active", "1")->random()->name;
            $u->addToGroup($random_group_name);

            // Generate a random number of entries
            $n = rand(1,50);
            Entry::factory()->count($n)->create(['user_id' => $u->id]);


            $faker = Faker::create();

            // Generate some feedback
            foreach (FeedbackGroup::all() as $group){

                // Get the questions this user can answer
                $questions = $group->userQuestions($u);

                // Go through each question
                foreach ($questions as $question){
                    $answer = $this->answerQuestion($question, $faker);

                    // Save
                    UserFeedback::create([
                        "feedback_question_id" => $question->id,
                        "user_id" => $u->id,
                        "answer" => $answer
                    ]);
                }
            }
        });

    }

    private function answerQuestion(FeedbackQuestion $question, Generator $faker){

        switch($question->question_type){

            case "radio":
                $options = $question->data["options"];
                return $options[array_rand($options)]["id"];
                break;
            default:
                return $faker->text();
        }


    }
}
