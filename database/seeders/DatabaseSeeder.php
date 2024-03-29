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
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TarifaSeeder::class,
            SexSeeder::class,
            IdentificationSeeder::class,
            RhSeeder::class,
            mediosSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
