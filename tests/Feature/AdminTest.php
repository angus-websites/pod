<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\core\RoleSeeder;
use Database\Seeders\core\TemplateSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Test that the number of users
     * displayed to the admin is correct
     */
    public function test_user_count_correct(){

        // Create 10 example users
        User::factory()->count(10)->hasEntries(10)->create();

        // Login as the admin
        $this->actingAs($this->admin);

        // Visit the dashboard
        $response = $this->get(route('dashboard'));

        // Check we get the correct data back
        $response->assertInertia(fn(Assert $page) => $page
            ->where('userCount', 11)
            ->etc()
        );
    }
}
