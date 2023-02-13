<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Entry;
use App\Models\Template;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::truncate();
        User::truncate();
        Entry::truncate();

        // Create the Templates
        $this->call(TemplateSeeder::class);

        // Create some users with entries
        User::factory()->count(5)
            ->hasEntries(12)
            ->create();
    }
}
