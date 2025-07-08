<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminExists = User::where('email', 'admin@enthusiastverse.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Admin EnthusiastVerse',
                'email' => 'admin@enthusiastverse.com',
                'password' => Hash::make('admin123456'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@enthusiastverse.com');
            $this->command->info('Password: admin123456');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}