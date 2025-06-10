<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('1234567890'),
            'role' => 'superadmin',
            'is_approved' => true
        ]);

        \App\Models\User::create([
            'name' => 'Admin Desa',
            'email' => 'admin666@gmail.com',
            'password' => bcrypt('1234567890'),
            'role' => 'admin',
            'is_approved' => true
        ]);
    }

}
