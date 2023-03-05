<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

//Models
use App\Models\User;
use App\Models\Role;

//Support
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
      $superAdminRole=Role::where('name', '=', 'Super Admin')->firstOrFail();
      if(config('admin.admin_name')) {
        $admin=User::create([
          'name' => config('admin.admin_name'),
          'email' => config('admin.admin_email'),
          'role_id' => $superAdminRole->id,
          'password' => Hash::make(config('admin.admin_password')),
        ]);
        $admin->giveFeature('Admin');
      }
      
    }
}
