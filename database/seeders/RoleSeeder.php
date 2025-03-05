<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run()
    {
        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $brandOwner = Role::firstOrCreate(['name' => 'brand_owner']);
        $storeOwner = Role::firstOrCreate(['name' => 'store_owner']);

        // Define permissions
        $permissions = [
            // Brand Owner Permissions
            'manage brands',
            'manage products',
            'view racks',
            'request rental',
            'manage agreements',
            'track shipments',
            'make payments',

            // Store Owner Permissions
            'manage store',
            'manage racks',
            'approve rentals',
            'validate shipments',
            'receive payments',

            // Admin Permissions
            'approve users',
            'manage users',
            'view all transactions',
            'resolve disputes',
            'access reports'
        ];

        // Create permissions if they don’t exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $brandOwner->syncPermissions([
            'manage brands',
            'manage products',
            'view racks',
            'request rental',
            'manage agreements',
            'track shipments',
            'make payments',
        ]);

        $storeOwner->syncPermissions([
            'manage store',
            'manage racks',
            'approve rentals',
            'validate shipments',
            'receive payments',
        ]);

        $admin->syncPermissions(Permission::all());
    }
}
