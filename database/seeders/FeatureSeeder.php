<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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
            'active' => false,
            'description' => 'Users can provide feedback on their experience using the app'
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


        // Group B
        $groupB = FeatureGroup::create([
            'name' => 'Group B',
            'bg' => '#DF369D',
            'fg' => '#FFFFFF',
        ]);
        $groupB->addFeature($leaderboard);
        $groupB->addFeature($totalWords);
        $groupB->addFeature($feedback);

        // Group C
        $groupC = FeatureGroup::create([
            'name' => 'Group C',
            'bg' => '#EEDD55',
            'fg' => '#5e550c',
        ]);
        $groupC->addFeature($leaderboard);
        $groupC->addFeature($totalWords);
        $groupC->addFeature($streaks);
        $groupC->addFeature($feedback);

        // Group D
        $groupD = FeatureGroup::create([
            'name' => 'Group D',
            'bg' => '#72C13F',
            'fg' => '#0e4d0e',
        ]);
        $groupD->addFeature($totalWords);
        $groupD->addFeature($feedback);

        // Group E
        $groupE = FeatureGroup::create([
            'name' => 'Group E',
            'bg' => '#9572F3',
            'fg' => '#FFFFFF',
        ]);
        $groupE->addFeature($ranked);
        $groupE->addFeature($streaks);
        $groupE->addFeature($totalWords);
        $groupE->addFeature($feedback);

        // Group F
        $groupF = FeatureGroup::create([
            'name' => 'Group F',
            'bg' => '#717171',
            'fg' => '#FFFFFF',
        ]);
        $groupF->addFeature($feedback);

    }
}
