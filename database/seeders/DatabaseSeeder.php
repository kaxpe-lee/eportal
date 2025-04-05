<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        

        DB::table('countries')->insert([
            'name' => 'España',
            'abr' => 'ES'
        ]);

        DB::table('states')->insert([
            'name' => 'Alicante',
            'country_id' => 1
        ]);

        DB::table('cities')->insert([
            'name' => 'Elche',
            'country_id' => 1,
            'state_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'country_id' => 1,
            'state_id' => 1,
            'city_id' => 1
        ]);
        
    }
}
