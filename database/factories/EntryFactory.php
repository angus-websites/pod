<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

        return [
            'title'=>$title,
            'content'=>$content,
            'date'=>$this->faker->date,
        ];
    }
}
