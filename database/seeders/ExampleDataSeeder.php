<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

//Models
use App\Models\User;
use App\Models\Entry;

//Support
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      User::truncate();
      Entry::truncate();

      // Create some users with entries
      User::factory()->count(5)
          ->hasEntries(12)
          ->create();
      
    }
}
