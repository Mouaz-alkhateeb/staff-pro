<?php

namespace Database\Seeders;

use App\Domain\Entity\User;
use App\Domain\State\UserStatuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'first_name' => 'mouaz',
            'last_name' => 'alkhateeb',
            'email' => 'mouaz@gmail.com',
            'phone_number' => '0962144639',
            'email_verified_at' => now(),
            'user_status_id' => UserStatuses::ACTIVE_USER,
            'gender' => 'Male',
            'password' => Hash::make('password'), // password
        ]);
    }
}
