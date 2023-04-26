<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Entry;
use App\Models\User;
use Database\Seeders\core\FeedbackSeeder;
use Illuminate\Database\Seeder;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

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
