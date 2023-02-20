<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

//Models
use App\Models\Role;
use App\Models\User;

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

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      //Clear data
      User::truncate();
      Role::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');


      // User
      Role::create([
        'id' => 1,
        'name' => "User",
        'code' => "Usr",
        'description' => "A normal user of the application",
      ]);

      // Admin
      Role::create([
        'id' => 2,
        'name' => "Admin",
        'code' => "Am",
        'description' => "As an admin you have full control of the application",
      ]);


      // Super Admin
      Role::create([
        'id' => 3,
        'name' => "Super Admin",
        'code' => "Sam",
        'description' => "The Goat",
        'changeable' => 0,
      ]);

    }
}
