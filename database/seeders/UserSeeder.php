<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'name' => 'Admin Admin',
            'email' => 'synicare@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'date_of_birth' => '2022-02-16',
            'phone' => '+1 (786) 864-7701',
        ]);
    }
}
