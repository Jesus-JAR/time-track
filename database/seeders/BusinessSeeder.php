<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = new Business();
        $Admin = DB::table('business')->insert(
            [
                'name' => 'Super Admin',
                'created_at' => now(),
            ],
        );

        $company = new Business();
        $company = DB::table('business')->insert(
            [
                'name' => 'Nintendo',
                'description' => 'Nintendo is one of the leading international interactive entertainment companies, and is focused on the development, production and sale of consoles and video games',
                'address' => '10 Rockefeller Plaza, New York, NY 10020, United States',
                'created_at' => now(),
            ],
        );
        $company2 = new Business();
        $company2 = DB::table('business')->insert(
            [
                'name' => 'Coca-cola',
                'description' => 'Company dedicated to the sale of carbonated drinks',
                'address' => 'Coca Cola Pl SE Atlanta (HQ), GA',
                'created_at' => now(),
            ]
        );
    }
}
