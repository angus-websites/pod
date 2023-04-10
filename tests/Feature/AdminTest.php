<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Template;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TemplateSeeder;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use JustSteveKing\Laravel\FeatureFlags\Models\FeatureGroup;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
        $this->seed(TemplateSeeder::class);


        // Create the admin
        $this->admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $this->admin->role_id = Role::where('name', '=', 'Super Admin')->firstOrFail()->id;
        $this->admin->save();

    }

    /**
     * Dashboard test
     */
    public function test_admin_dashboard()
    {

        // Create 10 example users
        User::factory()->count(10)->hasEntries(10)->create();

        // Login as the admin
        $this->actingAs($this->admin);

        // Visit the dashboard
        $response = $this->get(route('dashboard'));

        // Check we get the correct data back
        $response->assertInertia(fn(Assert $page) => $page
            ->has('featureGroups')
            ->has('features')
            ->has('users')
            ->etc()
        );

    }
}
