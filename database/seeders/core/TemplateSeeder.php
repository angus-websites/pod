<?php

namespace Database\Seeders\core;

//Models
use App\Models\Entry;
use App\Models\Template;
use Illuminate\Database\Seeder;


class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Clear data
        Entry::truncate();
        Template::truncate();

        // General template
        Template::create([
          'name' => "General",
          'description' => "A normal diary entry",
          'icon' => 'general.svg',
          'fields' => [
            [
                'id' => 'title',
                'label' => 'Entry title',
                'type' => 'text',
                'required' => true,
                'validation' => ['required', 'max:100'],
            ],
            [
                'id' => 'date',
                'label' => 'Date',
                'type' => 'date',
                'required' => true,
                'validation' => ['required', 'date', 'before_or_equal:today'],
            ],
            [
                'id' => 'content',
                'label' => 'Entry content',
                'encrypted' => true,
                'type' => 'raw',
                'required' => true,
                'validation' => ['required', 'max:3000'],
            ],
          ]
        ]);

        // Training template
        Template::create([
          'name' => "Training",
          'description' => "For when you have completed some training",
          'icon' => 'training.svg',
          'fields' => [
            [
                'id' => 'title',
                'label' => 'Name of training',
                'type' => 'text',
                'required' => true,
                'validation' => ['required', 'max:100'],
            ],
            [
                'id' => 'date',
                'label' => 'Date',
                'type' => 'date',
                'required' => false,
                'validation' => ['date', 'before_or_equal:today'],
            ],
            [
                'id' => 'what_i_learned',
                'label' => 'What did you learn?',
                'type' => 'raw',
                'required' => true,
                'encrypted' => true,
                'validation' => ['required', 'max:5000'],
            ],

          ],
        ]);

        // Skill template
        Template::create([
          'name' => "New Skill",
          'description' => "For when you have learned a new skill",
          'icon' => 'skill.svg',
          'fields' => [
            [
                'id' => 'title',
                'label' => 'The new skill you learned',
                'type' => 'text',
                'required' => true,
                'validation' => ['required', 'max:100'],
            ],
            [
                'id' => 'date',
                'label' => 'When did you learn this new skill?',
                'type' => 'date',
                'required' => false,
                'validation' => ['date', 'before_or_equal:today'],
            ],
            [
                'id' => 'what_i_learned',
                'label' => 'How did you learn this skill?',
                'type' => 'raw',
                'required' => true,
                'encrypted' => true,
                'validation' => ['required', 'max:5000'],
            ],

          ],
        ]);

        // Feedback template
        Template::create([
            'name' => "Feedback",
            'description' => "For if you receive feedback from something",
            'fields' => [
                [
                    'id' => 'title',
                    'label' => 'Title for the feedback',
                    'type' => 'text',
                    'required' => true,
                    'validation' => ['required', 'max:100'],
                ],
                [
                    'id' => 'date',
                    'label' => 'When did you receive this feedback?',
                    'type' => 'date',
                    'validation' => ['date', 'before_or_equal:today'],
                ],
                [
                    'id' => 'the_feedback',
                    'label' => 'What was the feedback?',
                    'type' => 'raw',
                    'encrypted' => true,
                    'required' => true,
                    'validation' => ['required', 'max:5000'],
                ],
                [
                    'id' => 'improvement',
                    'label' => 'What is your plan to act on the feedback?',
                    'type' => 'raw',
                    'encrypted' => true,
                    'validation' => ['max:5000'],
                ],

            ],
        ]);
    }
}
