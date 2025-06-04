<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::createOrFirst([
            'name' => 'Aditya Kumar',
            'email' => 'contact@adityadev.in',
            'password' => Hash::make('password'),
        ]);
    }
}
