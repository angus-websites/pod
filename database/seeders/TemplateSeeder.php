<?php

namespace Database\Seeders;

//Models
use App\Models\Template;
use App\Models\Entry;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'validation' => ['required', 'date'],
            ],
            [
                'id' => 'content',
                'label' => 'Entry content',
                'type' => 'textarea',
                'required' => true,
                'validation' => ['required', 'max:3000'],
            ],
          ]
        ]);

        // Training template
        Template::create([
          'name' => "Training",
          'description' => "For when you have completed some training",
          'fields' => [
            [
                'id' => 'title',
                'label' => 'Name of training',
                'type' => 'text',
                'required' => true,
                'validation' => ['required', 'max:100'],
            ],
            [
                'id' => 'date_started',
                'label' => 'Training start date',
                'type' => 'date',
                'required' => false,
                'validation' => ['date'],
            ],
            [
                'id' => 'date_completed',
                'label' => 'Training completion date',
                'type' => 'date',
                'required' => false,
                'validation' => ['date'],
            ],
            [
                'id' => 'what_i_learned',
                'label' => 'What did I learn?',
                'type' => 'textarea',
                'required' => true,
                'validation' => ['required', 'max:3000'],
            ],

          ],
        ]);
    }
}
