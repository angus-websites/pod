<?php

namespace Database\Seeders\testing;

use App\Models\Entry;
use App\Models\User;
use Illuminate\Database\Seeder;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

class BulkUserSeeder extends Seeder
{
    public static int $numberOfUsers = 50;
    /**
     * Will generate some
     */
    public function run(){

        User::factory()->count($this::$numberOfUsers)->create()->each(function ($u){

            // Assign a random group to this user
            $random_group_name = FeatureGroup::all()->where("active", "1")->random()->name;
            $u->addToGroup($random_group_name);

            // Random number of entries
            $n = rand(5,35);

            Entry::factory()->count($n)->create(['user_id' => $u->id]);
        });
    }
}
