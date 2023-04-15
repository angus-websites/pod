<?php

namespace Tests\Feature;


use App\Models\Role;
use App\Models\User;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\FeedbackSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TemplateSeeder;
use Database\Seeders\testing\FeedbackTestSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // Seed features and ensure active
        $this->seed(FeatureSeeder::class);
        Feature::where("name", "=", "feedback")->update(['active'=>'1']);

    }

    /**
     * Test a normal user can
     * access the feedback page when
     * given the feature, when it's active
     *
     */
    public function test_user_with_feature_can_access_feedback_when_active()
    {

        // Create user
        $user = User::factory()->create();

        // Give the feedback feature
        $user->giveFeature("feedback");

        // Acting as this user
        $this->actingAs($user);

        // Test we can access the page
        $response = $this->get(route('feedback'));
        $response->assertStatus(200);

    }

    /**
     * Test an admin can access the feedback page when
     * its active
     */
    public function test_admin_can_access_feedback_when_active()
    {

        // -------- Create admin --------

        $this->seed(RoleSeeder::class);
        $this->seed(TemplateSeeder::class);

        // Create the admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $admin->role_id = Role::where('name', '=', 'Super Admin')->firstOrFail()->id;
        $admin->save();

        // Acting as this user
        $this->actingAs($admin);

        // Test we can access the page
        $response = $this->get(route('feedback'));
        $response->assertStatus(200);

    }

    public function test_user_without_feature_cannot_access_feedback()
    {
        // Create user
        $user = User::factory()->create();

        // Acting as this user
        $this->actingAs($user);

        // Test we cannot access the page
        $response = $this->get(route('feedback'));
        $response->assertStatus(403);
    }

    public function test_user_with_feature_cannot_access_feedback_when_inactive()
    {
        // Disable the feature
        Feature::where("name", "=", "feedback")->update(['active'=>'0']);

        // Create user
        $user = User::factory()->create();

        // Give the feedback feature
        $user->giveFeature("feedback");

        // Acting as this user
        $this->actingAs($user);

        // Test we cannot access the page
        $response = $this->get(route('feedback'));
        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_feedback_if_it_doesnt_exist()
    {
        // Delete the row
        Feature::where("name", "=", "feedback")->delete();

        // -------- Create admin --------

        $this->seed(RoleSeeder::class);
        $this->seed(TemplateSeeder::class);

        // Create the admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $admin->role_id = Role::where('name', '=', 'Super Admin')->firstOrFail()->id;
        $admin->save();

        // Acting as this user
        $this->actingAs($admin);

        // Test we can access the page
        $response = $this->get(route('feedback'));
        $response->assertStatus(403);
    }

    public function test_feedback_works_with_seed_data()
    {
        // Seed
        $this->seed(FeedbackSeeder::class);

        // Create user
        $user = User::factory()->create();

        // Give the feedback feature
        $user->giveFeature("feedback");

        // Acting as this user
        $this->actingAs($user);

        // Test we can access the page
        $response = $this->get(route('feedback'));
        $response->assertStatus(200);
    }

    public function test_user_with_feature_receives_feedback_for_feature()
    {
        // Create some test feedback data
        $this->seed(FeedbackTestSeeder::class);

        // Create user
        $user = User::factory()->create();

        // Give the feedback & leaderboard feature
        $user->giveFeature("feedback");
        $user->giveFeature("leaderboard");

        // Acting as this user
        $this->actingAs($user);

        // Test we can access the page
        $response = $this->get(route('feedback'));

        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('feedbackGroups.data.0.questions.0', fn (Assert $page) => $page
                ->where('name','Q1')
                ->etc()
            )
        );
    }

    public function test_user_without_feature_does_not_receives_feedback_for_feature()
    {
        // Create some test feedback data
        $this->seed(FeedbackTestSeeder::class);

        // Create user
        $user = User::factory()->create();

        // Give the feedback & leaderboard feature
        $user->giveFeature("feedback");

        // Acting as this user
        $this->actingAs($user);

        // Test we can access the page
        $response = $this->get(route('feedback'));

        $response->assertInertia(fn (Assert $page) => $page
            // Checking nested properties using "dot" notation...
            ->has('feedbackGroups.data.0', fn (Assert $page) => $page
                ->missing('questions.0')
                ->etc()
            )
        );
    }


}
