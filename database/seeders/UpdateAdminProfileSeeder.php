<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateAdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find or create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'user_type' => 'admin'
            ]
        );

        // Update admin with profile data
        $admin->update([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone' => '+1 (555) 123-4567',
            'bio' => 'System administrator with 5+ years of experience managing e-commerce platforms and ensuring optimal user experience. Passionate about technology and committed to delivering exceptional digital solutions.',
            'preferences' => [
                'email_notifications' => true,
                'push_notifications' => true,
                'marketing_updates' => false,
                'theme' => 'light',
                'language' => 'en',
                'two_factor_enabled' => false,
            ]
        ]);

        $this->command->info('Admin profile updated successfully!');
        $this->command->info('Login credentials: admin@admin.com / Admin@123');
    }
}
