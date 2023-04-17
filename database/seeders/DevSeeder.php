<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\core\AdminSeeder;
use Database\Seeders\core\FeatureSeeder;
use Database\Seeders\core\FeedbackSeeder;
use Database\Seeders\core\RoleSeeder;
use Database\Seeders\core\TemplateSeeder;
use Illuminate\Database\Seeder;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

class DevSeeder extends Seeder
{
    /**
     * For seeding a database
     * for development purposes, this
     * will create fake users and entries
     *
     * @return void
     */
    public function run()
    {

        // Create some roles for the app
        $this->call(RoleSeeder::class);

        // Create the Templates
        $this->call(TemplateSeeder::class);

        // Call FeatureSeeder
        $this->call(FeatureSeeder::class);

        // Admin seed
        $this->call(AdminSeeder::class);

        // Feedback Seeding
        $this->call(FeedbackSeeder::class);

        // Create some users with entries
        User::factory()->count(50)->hasEntries(25)->create()->each(function ($u){
            // Assign a random group to this user
            $random_group_name = FeatureGroup::all()->where("active", "1")->random()->name;
            $u->addToGroup($random_group_name);
        });



    }
}
