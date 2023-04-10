<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Entry;
use App\Models\Role;
use App\Models\Template;

use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Template::truncate();
        DB::table('feature_groups')->truncate();
        DB::table('feature_feature_group')->truncate();
        DB::table('feature_group_user')->truncate();
        DB::table('feature_user')->truncate();
        DB::table('features')->truncate();
        User::truncate();
        Entry::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(RoleSeeder::class);

        // Create the Templates
        $this->call(TemplateSeeder::class);

        // Call FeatureSeeder
        $this->call(FeatureSeeder::class);

        // Admin seed
        $this->call(AdminSeeder::class);

        // Create some users with entries
        User::factory()->count(50)->hasEntries(rand(5,50))->create()->each(function ($u){

            // Assign a random group to this user
            $random_group_name = FeatureGroup::all()->where("active", "1")->random()->name;
            $u->addToGroup($random_group_name);
        });

    }
}
