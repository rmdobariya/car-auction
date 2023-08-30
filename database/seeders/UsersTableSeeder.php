<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'user_type' => 'admin',
                    'name' => 'Super Admin',
                    'email' => 'admin@gmail.com',
                    'image' => NULL,
                    'password' => '$2y$10$W5NTYI/7SAkjycNYfW7Z.uVCZuB7N15p4BINCyfqsSVNGwlk1fD22',
                    'panel_mode' => 1,
                    'locale' => 'en',
                    'status' => 'active',
                    'remember_token' => NULL,
                    'created_at' => NULL,
                    'updated_at' => '2021-08-16 14:00:30',
                ),
        ));

    }
}
