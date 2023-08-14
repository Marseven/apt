<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Atelier;
use App\Models\SecurityObject;
use App\Models\SecurityPermission;
use App\Models\SecurityRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        SecurityObject::create([
            'name' => 'BackEnd',
            'url' => env('APP_URL') . 'admin/',
            'icon' => 'admin',
            'enable' => 1,
        ]);

        SecurityObject::create([
            'name' => 'FrontEnd',
            'url' => env('APP_URL'),
            'icon' => 'front',
            'enable' => 1,
        ]);

        SecurityRole::create([
            'name' => 'SuperAdmin',
            'security_object_id' => 1,
        ]);

        SecurityRole::create([
            'name' => 'Admin',
            'security_object_id' => 1,
        ]);

        SecurityRole::create([
            'name' => 'Scrutateur',
            'security_object_id' => 1,
        ]);

        SecurityRole::create([
            'name' => 'Membre',
            'security_object_id' => 2,
        ]);

        SecurityPermission::create([
            'name' => 'Users',
            'description' => "Users",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Membres',
            'description' => "Membres",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Candidats',
            'description' => "Candidats",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Votes',
            'description' => "Votes",
            'user_id' => 1,
        ]);

        User::create([
            'name' => 'Jean Doe',
            'phone' => '074010203',
            'email' => 'superadmin@akandapourtous.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'security_role_id' => 1,
        ]);

        User::create([
            'name' => 'Peter Parker',
            'phone' => '074010204',
            'email' => 'admin@akandapourtous.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'security_role_id' => 2,
        ]);

        User::create([
            'name' => 'Clark Kent',
            'phone' => '074010205',
            'email' => 'scrutateur@akandapourtous.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'security_role_id' => 3,
        ]);
    }
}
