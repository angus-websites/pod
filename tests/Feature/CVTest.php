<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TemplateSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;
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

//    public function test_user_with_feature_can_generate_cv_from_entries()
//    {
//        $this->seed(TemplateSeeder::class);
//
//        // Create user
//        $user = User::factory()->hasEntries(5)->create();
//
//        // Give the CV builder feature
//        $user->giveFeature("CV Builder");
//
//        // Acting as this user
//        $this->actingAs($user);
//
//        // Test we can access the page
//        $response = $this->get(route('cv'));
//
//        // Check we get the correct data back
//        $response->assertInertia(fn (Assert $page) => $page
//            // Checking nested properties using "dot" notation...
//            ->has('data')
//        );
//
//    }

}
