<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\core\TemplateSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntryTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(TemplateSeeder::class);
        $this->user = User::factory()->hasEntries(5)->create();

    }

    public function test_entry_index()
    {
        // Login
        $this->actingAs($this->user);

        $response = $this->get('/entries');
        $response->assertStatus(200);
    }

    public function test_entry_index_fails_if_not_authenticated()
    {
        // Login
        $this->actingAs($this->user);

        $response = $this->get('/entries');
        $response->assertStatus(200);
    }


    public function test_create_entry()
    {
        $this->actingAs($this->user);

        $response = $this->get('/entries/create');
        $response->assertStatus(200);
    }



    public function test_create_entry_fails_if_not_authenticated()
    {
        $response = $this->get('/entries/create');
        $response->assertStatus(302);
    }

    public function test_show_entry()
    {
        $this->actingAs($this->user);

        $e = $this->user->entries()->first();

        $response = $this->get('/entries/'.$e->id);
        $response->assertStatus(200);
    }

    public function test_show_entry_fails_if_user_doesnt_own_entry()
    {

        // Create an attacker bob
        $bob = User::factory()->hasEntries(2)->create();

        // Fetch one of our other users entries
        $e = $this->user->entries()->first();

        // Login as bob
        $this->actingAs($bob);

        $response = $this->get('/entries/'.$e->id);

        // Assert we get permission denied
        $response->assertStatus(403);
    }
}
