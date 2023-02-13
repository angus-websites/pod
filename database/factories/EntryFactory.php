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

        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $title = $this->faker->realText(25);
        $content = "<h1>{$this->faker->realText(20)}</h1>";
        foreach ($paragraphs as $para) {
            $content .= "<p>{$para}</p>";
        }

        $general_template = Template::where('name', '=', 'General template')->firstOrFail();

        return [
            'title'=>$title,
            'content'=>$content,
            'date'=>$this->faker->date,
            'template_id'=>$general_template,
        ];
    }
}
