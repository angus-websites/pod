<?php

namespace Tests\Feature;

use App\Models\Template;
use App\Models\User;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\TemplateSeeder;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp(): void
    {
        parent::setUp();
        $this->seed(TemplateSeeder::class);
        $this->seed(FeatureSeeder::class);
    }

    /**
     * Test we get the correct inertia response
     * from the dashboard for entry count leaderboard
     */
    public function test_entry_count_leaderboard()
    {

        // Create our user with 10 entries
        $user = User::factory()->hasEntries(10)->create();

        // Give the leaderboard feature
        $user->giveFeature("leaderboard");

        // Acting as this user
        $this->actingAs($user);

        // Visit the dashboard
        $response = $this->get(route('dashboard'));

        // Check we get the correct data back
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.entry count.leaderboard')
        );

    }

    /**
     * Test the correct data is returned when the user
     * has the streak feature
     */
    public function test_streak_leaderboard(){

        // Create our user with 10 entries
        $user = User::factory()->hasEntries(5)->create();

        // Give the leaderboard feature
        $user->giveFeature("leaderboard");
        $user->giveFeature("streaks");

        // Acting as this user
        $this->actingAs($user);

        // Visit the dashboard
        $response = $this->get(route('dashboard'));

        // Check the user is number 1 on the leaderboard
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.streak.leaderboard.data.0', fn (Assert $page) => $page
                ->where('id', $user->id)
                ->where('rank', "1/1")
                ->etc()
            )
        );
    }
}
