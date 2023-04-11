<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TemplateSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use Tests\TestCase;

class CVTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test a normal user can
     * access the CV page when
     * given the feature, when it's active
     *
     */
    public function test_user_with_feature_can_access_cv_builder_when_active()
    {
        $this->seed(FeatureSeeder::class);
        // Ensure we have the features & it's enabled
        Feature::where("name", "=", "CV Builder")->update(['active'=>'1']);

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
        $this->seed(FeatureSeeder::class);

        // Ensure we have the features & it's enabled
        Feature::where("name", "=", "CV Builder")->update(['active'=>'1']);

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
}
