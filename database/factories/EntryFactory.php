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
        $rand = rand(0, 2);

        switch ($rand) {

            // Training template
            case 0:

                $training_template = Template::where('name', '=', 'Training')->firstOrFail();

                $name_of_training = $this->faker->text(10);
                $paragraphs = $this->faker->paragraphs(rand(2, 6));
                $what_i_learned = "";
                foreach ($paragraphs as $para) {
                    $what_i_learned .= $para;
                }

                $entry_content = [
                    'template_id' => $training_template,
                    'data' => [
                        'title'=>$name_of_training,
                        'what_i_learned'=>$what_i_learned,
                        "date" => $this->getDate(),
                    ]
                ];
                break;

            // Skill template
            case 1:

                $skill_template = Template::where('name', '=', 'New Skill')->firstOrFail();

                $skill_name = $this->faker->realText(10);
                $paragraphs = $this->faker->paragraphs(rand(2, 6));
                $what_i_learned = "";
                foreach ($paragraphs as $para) {
                    $what_i_learned .= $para;
                }

                $entry_content = [
                    'template_id' => $skill_template,
                    'data' => [
                        'title'=>$skill_name,
                        'what_i_learned'=>$what_i_learned,
                        'date'=>$this->getDate()
                    ]
                ];
                break;

            // General template
            default:

                $general_template = Template::where('name', '=', 'General')->firstOrFail();

                $paragraphs = $this->faker->paragraphs(rand(2, 6));
                $title = $this->faker->realText(25);
                $content = "<h1>{$this->faker->realText(20)}</h1>";
                foreach ($paragraphs as $para) {
                    $content .= "<p>{$para}</p>";
                }



                $entry_content = [
                    'template_id'=>$general_template,
                    'data' => [
                        'title'=>$title,
                        'content'=>$content,
                        'date'=>$this->getDate()
                    ]
                ];
                break;
        }

        return $entry_content;
    }


    private function getDate(): string
    {
        return $this->faker->dateTimeThisYear()->format("d-m-Y");
    }
}
