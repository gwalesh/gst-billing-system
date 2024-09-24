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
            'name' => "Gwalesh",
            'email' =>  "gwalesh@webwolf.in",
            'password' => Hash::make('Justtesting@8826')
        ];

        User::insert($user);
    }
}
