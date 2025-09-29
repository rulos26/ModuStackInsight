<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $root = User::create([
            'name' => 'Root',
            'email' => 'root@example.com',
            'password' => bcrypt('root'),
        ]);
        $root->assignRole('superadmin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');

        $eval = User::create([
            'name' => 'Evaluador',
            'email' => 'evaluador@example.com',
            'password' => bcrypt('evaluador'),
        ]);
        $eval->assignRole('evaluador');
    }
}
