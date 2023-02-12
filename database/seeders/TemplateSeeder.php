<?php

namespace Database\Seeders;

//Models
use App\Models\Template;

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
        Template::truncate();

        // General template
        Template::create([
          'name' => "General template",
          'description' => "A normal diary entry",
          'fields' => [
            [
                'id' => 'title',
                'label' => 'Entry title',
                'type' => 'text',
                'required' => true,
            ],
            [
                'id' => 'date',
                'label' => 'Date',
                'type' => 'date',
                'required' => true,
            ],
            [
                'id' => 'content',
                'label' => 'Entry content',
                'type' => 'textarea',
                'required' => true,
            ],
          ],
        ]);

        // Training template
        Template::create([
          'name' => "Training template",
          'description' => "For when you have completed some training",
          'fields' => [
            [
                'id' => 'name_of_training',
                'label' => 'Name of training',
                'type' => 'text',
                'required' => true,
            ],
            [
                'id' => 'date_started',
                'label' => 'Training start date',
                'type' => 'date',
                'required' => false,
            ],
            [
                'id' => 'date_completed',
                'label' => 'Training completion date',
                'type' => 'date',
                'required' => false,
            ],
            [
                'id' => 'what_i_learned',
                'label' => 'What did I learn?',
                'type' => 'textarea',
                'required' => true,
            ],

          ],
        ]);
    }
}
