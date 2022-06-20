<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        // bussines
        $this->call(BusinessSeeder::class);

        // Roles y permisos
        $this->call(RoleSeeder::class);

        // usuarios
        $this->call(UserSeeder::class);
    }
}
