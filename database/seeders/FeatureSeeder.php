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
            'description' => 'Similar to the leaderboard but users can see what position they rank compared to everyone else'
        ]);

        $streaks =  Feature::create([
            'name' => 'Streaks',
            'description' => 'Users can see their current streak of diary entries, each consecutive day of writing the streak goes up'
        ]);

        $totalWords =  Feature::create([
            'name' => 'Total word count',
            'description' => 'Users can see the total number of words they have written in all of their diary entries'

        ]);

        $achievements =  Feature::create([
            'name' => 'Achievements',
            'description' => 'Users unlock various achievements & digital awards for completing certain tasks in the app'
        ]);

        // ----- Seed our groups -----

        // Group A
        $groupA = FeatureGroup::create([
            'name' => 'Group A',
            'bg' => '#2191FB',
            'fg' => '#FFFFFF',
        ]);
        $groupA->addFeature($streaks);
        $groupA->addFeature($achievements);

        // Group B
        $groupB = FeatureGroup::create([
            'name' => 'Group B',
            'bg' => '#DF369D',
            'fg' => '#FFFFFF',
        ]);
        $groupB->addFeature($leaderboard);
        $groupB->addFeature($totalWords);

        // Group C
        $groupC = FeatureGroup::create([
            'name' => 'Group C',
            'bg' => '#EEDD55',
            'fg' => '#5e550c',
        ]);
        $groupC->addFeature($leaderboard);
        $groupC->addFeature($totalWords);
        $groupC->addFeature($streaks);

        // Group D
        $groupD = FeatureGroup::create([
            'name' => 'Group D',
            'bg' => '#72C13F',
            'fg' => '#0e4d0e',
        ]);
        $groupD->addFeature($totalWords);
        $groupD->addFeature($achievements);

        // Group E
        $groupE = FeatureGroup::create([
            'name' => 'Group E',
            'bg' => '#9572F3',
            'fg' => '#FFFFFF',
        ]);
        $groupE->addFeature($ranked);
        $groupE->addFeature($streaks);
        $groupE->addFeature($totalWords);
    }
}
