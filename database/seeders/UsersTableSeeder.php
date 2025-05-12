<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@gmail.com'),
                'usertype' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Patient One',
                'email' => 'patient1@gmail.com',
                'password' => Hash::make('patient1@gmail.com'),
                'usertype' => 'patient',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Patient Two',
                'email' => 'patient2@gmail.com',
                'password' => Hash::make('patient2@gmail.com'), // Note: password doesn't match email
                'usertype' => 'patient',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Scheduler User',
                'email' => 'scheduler@gmail.com',
                'password' => Hash::make('scheduler@gmail.com'),
                'usertype' => 'scheduler',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}