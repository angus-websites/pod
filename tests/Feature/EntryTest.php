<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\core\TemplateSeeder;
use Database\Seeders\DevSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_entry_content_encrypted()
    {
        $this->seed(TemplateSeeder::class);

        User::factory()->count(15)->hasEntries(2)->create();

    }
}
