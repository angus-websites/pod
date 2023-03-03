<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Entry;
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
        
        User::truncate();
        Entry::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create the Templates
        $this->call(TemplateSeeder::class);

        // Admin seed
        $this->call(AdminSeeder::class);

        $groupA = FeatureGroup::create([
            'name' => 'Group A'
        ]);

        $groupB = FeatureGroup::create([
            'name' => 'Group B'
        ]);


        $featureGroups = [$groupA, $groupB];


        // Create some users with entries
        User::factory()->count(5)->hasEntries(12)->create()->each(function ($u) use(&$featureGroups) {
            $random_group = $featureGroups[array_rand($featureGroups, 1)];
            $u->addToGroup($random_group->name);
        });;

    }
}
