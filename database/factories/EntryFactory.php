<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Template;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry>
 */
class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {        

        // Generate a random template
        $rand = rand(0, 1);

        switch ($rand) {

            // Training template
            case 0:

                $training_template = Template::where('name', '=', 'Training template')->firstOrFail();

                $name_of_training = $this->faker->realText(10);
                $start = $this->faker->dateTimeThisMonth();
                $end = $this->faker->dateTimeThisMonth();

                $paragraphs = $this->faker->paragraphs(rand(2, 6));
                $what_i_learned = "";
                foreach ($paragraphs as $para) {
                    $what_i_learned .= $para;
                }

                $entry_content = [
                    'title'=>$name_of_training,
                    'date_started'=>$start,
                    'date_completed'=>$end,
                    'what_i_learned'=>$what_i_learned,
                    'template_id' => $training_template
                ];
                break;
            
            // General template
            default:

                $general_template = Template::where('name', '=', 'General template')->firstOrFail();

                $paragraphs = $this->faker->paragraphs(rand(2, 6));
                $title = $this->faker->realText(25);
                $content = "<h1>{$this->faker->realText(20)}</h1>";
                foreach ($paragraphs as $para) {
                    $content .= "<p>{$para}</p>";
                }

                $entry_content = [
                    'title'=>$title,
                    'content'=>$content,
                    'date'=>$this->faker->date,
                    'template_id'=>$general_template,
                ];
                break;
        }

        return $entry_content;
    }
}
