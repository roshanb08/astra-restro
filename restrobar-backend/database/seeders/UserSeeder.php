<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Roshan',
            'middle_name' => 'O',
            'last_name' => 'Bhandari',
            'email' => 'roshan@astraedtech.com.np',
            'password' => Hash::make('Nepal@123'), // Hashed password
            'role' => 'global_admin',
            'status' => 1,
            'phone_number' => '+977 9702289595',
            'address' => 'Hetauda-19, Bastipur',
            'profile_picture' => null, // Default null if no picture
            'activation_token' => null, // Default null if no activation token
            'remember_token' => null,
            'two_factor_auth' => 0,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


// php artisan db:seed --class=UserSeeder
