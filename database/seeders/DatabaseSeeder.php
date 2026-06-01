<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['userid' => 'ADM001'],
            [
                'name' => 'Admin',
                'emailid' => 'admin@vaarahi.com',
                'password' => Hash::make('Vaarahi@123'),
                'mobileno' => '9092526272',
                'gender' => 'Male',
                'register_id' => 'REGADM001',
                'mid' => 'MID001',
                'role' => 'admin',
                'status' => 1,
                'date' => date('Y-m-d'),
                'date_of_birth' => '1990-01-01',
                'age' => 36,
            ]
        );
    }
}
