<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'uid'       => 'USER_00001',
            'name'      => 'Subhankar Sharma',
            'email'     => 'subhankar02@gmail.com',
            'role'      => 'admin',
            'password'  => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uid'       => 'USER_00002',
            'name'      => 'Ram',
            'email'     => 'ram101@gmail.com',
            'role'      => 'web_developer',
            'password'  => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uid'       => 'USER_00003',
            'name'      => 'Sham',
            'email'     => 'sham202@gmail.com',
            'role'      => 'android_developer',
            'password'  => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uid'       => 'USER_00004',
            'name'      => 'Rahim',
            'email'     => 'rahim303@gmail.com',
            'role'      => 'web_developer',
            'password'  => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uid'       => 'USER_00005',
            'name'      => 'Pritam',
            'email'     => 'pritam404@gmail.com',
            'role'      => 'android_developer',
            'password'  => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
        