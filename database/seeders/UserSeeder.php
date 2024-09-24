<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => "Admin",
            'email' =>  "admin@admin.com",
            'password' => Hash::make('Password@123')
        ];

        User::insert($user);
    }
}
