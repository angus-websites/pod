<?php

namespace Database\Seeders\testing;

use App\Models\Entry;
use App\Models\User;
use Database\Factories\EntryFactory;
use Illuminate\Database\Seeder;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

class BulkUserSeeder extends Seeder
{
    public function run(){

        User::factory()->count(9)->create()->each(function ($u){

            // Assign a random group to this user
            $random_group_name = FeatureGroup::all()->where("active", "1")->random()->name;
            $u->addToGroup($random_group_name);

            $n = rand(5,35);

            Entry::factory()->count($n)->create(['user_id' => $u->id]);
        });
    }
}
