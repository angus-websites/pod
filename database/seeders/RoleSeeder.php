<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

//Models
use App\Models\Role;

//Support
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //Clear data
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      Role::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');

      // Super Admin
      Role::create([
        'name' => "Super Admin",
        'code' => "Sam",
        'description' => "The Goat",
        'changeable' => 0,
      ]);

      // User
      Role::create([
        'name' => "User",
        'code' => "Usr",
        'description' => "A normal user of the application",
      ]);
      
      
      // Admin
      Role::create([
        'name' => "Admin",
        'code' => "Am",
        'description' => "As an admin you have full control of the application",
      ]);


    }
}
