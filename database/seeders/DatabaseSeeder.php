<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\core\AdminSeeder;
use Database\Seeders\core\FeatureSeeder;
use Database\Seeders\core\FeedbackSeeder;
use Database\Seeders\core\RoleSeeder;
use Database\Seeders\core\TemplateSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     * when the app is completely new
     * This can be run once on a fresh
     * production environment
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(FeedbackSeeder::class);
    }
}
