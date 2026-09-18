<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'Admin User',   'email' => 'admin@lodgify.com',   'role' => 'admin'],
            ['name' => 'Manager User', 'email' => 'manager@lodgify.com', 'role' => 'manager'],
            ['name' => 'Staff User',   'email' => 'staff@lodgify.com',   'role' => 'staff'],
        ];
        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'role' => $u['role'], 'password' => Hash::make('password')]
            );
        }
    }
}
