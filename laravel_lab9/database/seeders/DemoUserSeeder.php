<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'demo@huit.edu.vn'],
            ['name' => 'Demo Admin', 'password' => Hash::make('password123'), 'email_verified_at'=>now(), 'is_admin'=>true]
        );
    }
}
