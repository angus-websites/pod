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

        // Headers for the inertia partial reload
        $this->headers = [
            'HTTP_X-Inertia-Partial-Data' => 'featureData',
            'HTTP_X-Inertia-Partial-Component' => 'Dashboard/UserDashboard'

        ];
    }

    /**
     * Test we get leaderboard data from
     * the inertia request
     */
    public function test_leaderboard_data_exists()
    {

        // Create our user with 10 entries
        $user = User::factory()->hasEntries(10)->create();

        // Give the leaderboard feature
        $user->giveFeature("leaderboard");

        // Acting as this user
        $this->actingAs($user);

        // Visit the dashboard
        $response = $this->get(route('dashboard'), $this->headers);

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


        // Visit the route and request the partial reload data
        $response = $this->get(route('dashboard'), $this->headers);

        // Check the user is number 1 on the leaderboard & rank is correct
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.streak.leaderboard.data.0', fn (Assert $page) => $page
                ->where('id', $user->id)
                ->where('rank', "1/1")
                ->etc()
            )
        );
    }

    /**
     * Test the leaderboard but with multiple users
     */
    public function test_entry_count_leaderboard_with_multiple_users(){

        // Create 10 other users each with 5 entries
        User::factory()->count(10)->hasEntries(5)->create();

        // Create ranking users
        $third = User::factory()->hasEntries(6)->create();
        $second = User::factory()->hasEntries(8)->create();
        $first = User::factory()->hasEntries(10)->create();

        // Add the leaderboard feature
        $first->giveFeature("leaderboard");
        $second->giveFeature("leaderboard");
        $third->giveFeature("leaderboard");

        // ---------- 1st place test -----------

        // Acting as the first user
        $this->actingAs($first);

        // Visit the dashboard
        $response = $this->get(route('dashboard'), $this->headers);

        // Check the user is number 1 on the leaderboard & rank is correct
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.entry count.leaderboard.data.0', fn (Assert $page) => $page
                ->where('id', $first->id)
                ->where('rank', "1/13")
                ->etc()
            )
        );


        // ---------- 2nd place test -----------

        // Acting as the first user
        $this->actingAs($second);

        // Visit the dashboard
        $response = $this->get(route('dashboard'), $this->headers);

        // Check the user is number 1 on the leaderboard & rank is correct
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.entry count.leaderboard.data.1', fn (Assert $page) => $page
                ->where('id', $second->id)
                ->where('rank', "2/13")
                ->etc()
            )
        );

        // ---------- 3rd place test -----------

        // Acting as the first user
        $this->actingAs($third);

        // Visit the dashboard
        $response = $this->get(route('dashboard'), $this->headers);

        // Check the user is number 1 on the leaderboard & rank is correct
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.entry count.leaderboard.data.2', fn (Assert $page) => $page
                ->where('id', $third->id)
                ->where('rank', "3/13")
                ->etc()
            )
        );

    }

    /**
     * Test the word count leaderboard with multiple users
     */
    public function test_total_word_count_leaderboard_with_multiple_users(){

        // Create 10 other users each with 0 entries
        User::factory()->count(10)->create();

        // Create the number 1 rank
        $first = User::factory()->hasEntries(5)->create();

        // Add the leaderboard feature
        $first->giveFeature("leaderboard");
        $first->giveFeature("total word count");

        // Acting as the first user
        $this->actingAs($first);

        // Visit the dashboard
        $response = $this->get(route('dashboard'), $this->headers);

        // Check the user is number 1 on the leaderboard & rank is correct
        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('featureData.total word count.leaderboard.data.0', fn (Assert $page) => $page
                ->where('id', $first->id)
                ->where('rank', "1/11")
                ->etc()
            )
        );

    }
}
