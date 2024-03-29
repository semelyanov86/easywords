<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);

        $this->call(WordSeeder::class);
        $this->call(SampleSeeder::class);
    }
}
