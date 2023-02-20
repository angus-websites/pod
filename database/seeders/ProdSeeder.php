<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\Entry;
use App\Models\Template;

use Illuminate\Support\Facades\DB;

class ProdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed essential data
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TemplateSeeder::class);
    }
}
