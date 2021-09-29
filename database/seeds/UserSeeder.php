<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Acip Freshbone',
            'email' => 'acip',
            'password' => \Illuminate\Support\Facades\Hash::make('acip'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@rasumi.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Rasumi@2021'),
        ]);
    }
}
