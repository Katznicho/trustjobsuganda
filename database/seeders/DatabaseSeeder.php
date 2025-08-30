<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run our custom seeders
        $this->call([
            SkillCategorySeeder::class,
            SkillSeeder::class,
            LanguageSeeder::class,
        ]);

        // Create admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@trustjobs.com',
            'phone_e164' => '+256700000000',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Create sample employer
        User::create([
            'first_name' => 'John',
            'last_name' => 'Employer',
            'email' => 'employer@trustjobs.com',
            'phone_e164' => '+256700000001',
            'role' => 'employer',
            'password' => Hash::make('password'),
        ]);

        // Create sample worker
        User::create([
            'first_name' => 'Sarah',
            'last_name' => 'Worker',
            'email' => 'worker@trustjobs.com',
            'phone_e164' => '+256700000002',
            'role' => 'worker',
            'password' => Hash::make('password'),
        ]);
    }
}
