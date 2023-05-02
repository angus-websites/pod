<?php

namespace Database\Seeders\core;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('feature_groups')->truncate();
        DB::table('feature_feature_group')->truncate();
        DB::table('feature_group_user')->truncate();
        DB::table('feature_user')->truncate();
        DB::table('features')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // ----- Seed our features -----

        $leaderboard =  Feature::create([
            'name' => 'Leaderboard',
            'description' => 'The user can see a leaderboard, allowing other features to be compared with friends'
        ]);

        $ranked = Feature::create([
            'name' => 'Ranked',
            'description' => 'Similar to the leaderboard but users can only see what position they rank compared to everyone else'
        ]);

        $streaks =  Feature::create([
            'name' => 'Streaks',
            'description' => 'Users can see their current streak of diary entries, each consecutive day of writing the streak goes up'
        ]);

        $totalWords =  Feature::create([
            'name' => 'Total word count',
            'description' => 'Users can see the total number of words they have written in all of their diary entries'

        ]);

        $feedback =  Feature::create([
            'name' => 'Feedback',
            'description' => 'Users can provide feedback on their experience using the app'
        ]);

        $cvBuilder =  Feature::create([
            'name' => 'CV Builder',
            'description' => "Users can generate CV's from their entry content",
            'active' => 0
        ]);


        // ----- Seed our groups -----

        // Group A
        $groupA = FeatureGroup::create([
            'name' => 'Group A',
            'bg' => '#2191FB',
            'fg' => '#FFFFFF',
        ]);
        $groupA->addFeature($streaks);
        $groupA->addFeature($feedback);
        $groupA->addFeature($cvBuilder);

        // Group B
        $groupB = FeatureGroup::create([
            'name' => 'Group B',
            'bg' => '#DF369D',
            'fg' => '#FFFFFF',
        ]);
        $groupB->addFeature($totalWords);
        $groupB->addFeature($feedback);
        $groupB->addFeature($cvBuilder);


        // Group C
        $groupC = FeatureGroup::create([
            'name' => 'Group C',
            'bg' => '#EEDD55',
            'fg' => '#5e550c',
        ]);
        $groupC->addFeature($streaks);
        $groupC->addFeature($leaderboard);
        $groupC->addFeature($feedback);
        $groupC->addFeature($cvBuilder);


        // Group D
        $groupD = FeatureGroup::create([
            'name' => 'Group D',
            'bg' => '#72C13F',
            'fg' => '#0e4d0e',
        ]);
        $groupD->addFeature($totalWords);
        $groupD->addFeature($leaderboard);
        $groupD->addFeature($feedback);
        $groupD->addFeature($cvBuilder);

        // Group E
        $groupE = FeatureGroup::create([
            'name' => 'Group E',
            'bg' => '#9572F3',
            'fg' => '#FFFFFF',
        ]);
        $groupE->addFeature($streaks);
        $groupE->addFeature($ranked);
        $groupE->addFeature($feedback);
        $groupE->addFeature($cvBuilder);

        // Group F
        $groupF = FeatureGroup::create([
            'name' => 'Group F',
            'bg' => '#717171',
            'fg' => '#FFFFFF',
        ]);
        $groupF->addFeature($totalWords);
        $groupF->addFeature($ranked);
        $groupF->addFeature($feedback);
        $groupF->addFeature($cvBuilder);

        // Group G
        $groupG = FeatureGroup::create([
            'name' => 'Group G',
            'bg' => '#4E7EA5',
            'fg' => '#FFFFFF',
        ]);
        $groupG->addFeature($streaks);
        $groupG->addFeature($totalWords);
        $groupG->addFeature($leaderboard);
        $groupG->addFeature($feedback);
        $groupG->addFeature($cvBuilder);

        // Group H
        $groupH = FeatureGroup::create([
            'name' => 'Group H',
            'bg' => '#9268A5',
            'fg' => '#FFFFFF',
        ]);
        $groupH->addFeature($streaks);
        $groupH->addFeature($totalWords);
        $groupH->addFeature($ranked);
        $groupH->addFeature($feedback);
        $groupH->addFeature($cvBuilder);


        // Group I
        $groupI = FeatureGroup::create([
            'name' => 'Group I',
            'bg' => '#453F35',
            'fg' => '#FFFFFF',
        ]);
        $groupI->addFeature($feedback);
        $groupI->addFeature($cvBuilder);


    }
}
