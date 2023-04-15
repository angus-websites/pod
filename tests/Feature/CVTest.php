<?php

namespace Tests\Feature;

use App\Http\Controllers\CVController;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\core\FeatureSeeder;
use Database\Seeders\core\RoleSeeder;
use Database\Seeders\core\TemplateSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use Tests\TestCase;

class CVTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // Seed features and ensure active
        $this->seed(FeatureSeeder::class);
        Feature::where("name", "=", "CV Builder")->update(['active'=>'1']);

        // Lazy loaded headers
        $this->headers = [
            'HTTP_X-Inertia-Partial-Data' => 'data',
            'HTTP_X-Inertia-Partial-Component' => 'CV/Index'

        ];
    }

    /**
     * Test a normal user can
     * access the CV page when
     * given the feature, when it's active
     *
     */
    public function test_user_with_feature_can_access_cv_builder_when_active()
    {

        // Create user
        $user = User::factory()->create();

        // Give the CV builder feature
        $user->giveFeature("CV Builder");

        // Acting as this user
        $this->actingAs($user);

        // Test we can access the page
        $response = $this->get(route('cv'));
        $response->assertStatus(200);

    }

    /**
     * Test an admin can access the cv builder page when
     * its active
     */
    public function test_admin_can_access_cv_builder_when_active()
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
        $response = $this->get(route('cv'));
        $response->assertStatus(200);

    }

    public function test_user_without_feature_cannot_access_cv_builder()
    {
        // Create user
        $user = User::factory()->create();

        // Acting as this user
        $this->actingAs($user);

        // Test we cannot access the page
        $response = $this->get(route('cv'));
        $response->assertStatus(403);
    }

    public function test_user_with_feature_cannot_access_cv_builder_when_inactive()
    {
        // Disable the feature
        Feature::where("name", "=", "CV Builder")->update(['active'=>'0']);

        // Create user
        $user = User::factory()->create();

        // Give the CV builder feature
        $user->giveFeature("CV Builder");

        // Acting as this user
        $this->actingAs($user);

        // Test we cannot access the page
        $response = $this->get(route('cv'));
        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_cv_builder_if_it_doesnt_exist()
    {
        // Delete the row
        Feature::where("name", "=", "CV Builder")->delete();

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
        $response = $this->get(route('cv'));
        $response->assertStatus(403);
    }

    public function test_user_cannot_generate_cv_from_api_if_doesnt_have_access()
    {
        $this->seed(TemplateSeeder::class);

        // Create user
        $user = User::factory()->hasEntries(5)->create();

        // Acting as this user
        $this->actingAs($user);

        // Send a get request to the page
        $response = $this->call('GET', route('cv.download'), ["cvContent"=>"Hello world"]);

        // Assert a 403
        $response->assertStatus(403);

    }

    public function test_user_cannot_generate_cv_if_number_of_entries_too_small()
    {
        $numberOfEntries = CVController::$minEntries - 1;

        $this->seed(TemplateSeeder::class);

        // Create user
        $user = User::factory()->hasEntries($numberOfEntries)->create();

        // Give them the feature
        $user->giveFeature("CV Builder");

        // Acting as this user
        $this->actingAs($user);

        // Attempt to generate the CV
        $response = $this->get(route('cv'), $this->headers);

        // Assert a 403
        $response->assertStatus(403);


    }

}
