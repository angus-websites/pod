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
        User::factory()->count(10)->create()->each(function ($u){

            // Assign a random group to this user
            $random_group_name = FeatureGroup::all()->where("active", "1")->random()->name;
            $u->addToGroup($random_group_name);

            // Random number of entries
            $n = rand(5,20);

            Entry::factory()->count($n)->create(['user_id' => $u->id]);
        });

    }
}
