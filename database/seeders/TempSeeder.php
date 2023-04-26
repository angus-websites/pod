<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\core\FeedbackSeeder;
use Illuminate\Database\Seeder;

class TempSeeder extends Seeder
{
    /**
     * Use this seeder to seed
     * database from a production environment
     */
    public function run()
    {
        // Seed initial feedback data
        $this->call(FeedbackSeeder::class);

    }
}
