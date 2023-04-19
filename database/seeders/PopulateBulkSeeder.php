<?php

namespace Database\Seeders;

use Database\Seeders\testing\BulkUserSeeder;
use Illuminate\Database\Seeder;

class PopulateBulkSeeder extends Seeder
{
    /**
     * Modify this to customise feedback seeding
     *
     * @return void
     */
    public function run()
    {
        $this->call(BulkUserSeeder::class);
    }
}
