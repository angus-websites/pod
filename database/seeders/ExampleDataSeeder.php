<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

//Models
use App\Models\User;

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
      // Clear database
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      DB::table('entries')->truncate();
      DB::table('users')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');

      // Create some users with entries
      User::factory()->count(10)
          ->hasEntries(5)
          ->create();
      
    }
}
