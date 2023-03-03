<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Template::truncate();
        User::truncate();
        Entry::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create the Templates
        $this->call(TemplateSeeder::class);

        // Admin seed
        $this->call(AdminSeeder::class);

        // Create some users with entries
        User::factory()->count(5)
            ->hasEntries(12)
            ->create();
    }
}
