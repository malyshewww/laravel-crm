<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            ClaimSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
