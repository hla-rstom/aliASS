<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'phone' => '1234567890',
                'is_approved' => true
            ]
        );
        $admin->assignRole('admin');

        // Create a Brand Owner user
        $brandOwner = User::firstOrCreate(
            ['email' => 'brandowner@example.com'],
            [
                'name' => 'Brand Owner User',
                'password' => Hash::make('password'),
                'phone' => '0987654321',
                'is_approved' => true
            ]
        );
        $brandOwner->assignRole('brand_owner');

        // Create a Store Owner user
        $storeOwner = User::firstOrCreate(
            ['email' => 'storeowner@example.com'],
            [
                'name' => 'Store Owner User',
                'password' => Hash::make('password'),
                'phone' => '1122334455',
                'is_approved' => true
            ]
        );
        $storeOwner->assignRole('store_owner');

        echo "Admin, Brand Owner, and Store Owner users have been created successfully!\n";
    }
}
