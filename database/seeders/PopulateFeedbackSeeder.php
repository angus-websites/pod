<?php

namespace Database\Seeders;

use Database\Seeders\core\FeedbackSeeder;
use Database\Seeders\testing\BulkUserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopulateFeedbackSeeder extends Seeder
{
    /**
     * Modify this to customise feedback seeding
     *
     * @return void
     */
    public function run()
    {
        $this->call(BulkUserSeeder::class);
    }
}
