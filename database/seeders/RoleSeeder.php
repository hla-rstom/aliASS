<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = Role::create(['name' => 'super-admin']);
        $storeOwner = Role::create(['name' => 'store-owner']);
        $brandOwner = Role::create(['name' => 'brand-owner']);

        $permissions = [
            'manage stores',
            'manage racks',
            'manage brands',
            'manage products',
            'manage rentals',
            'manage requests'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdmin->givePermissionTo(Permission::all());
        $storeOwner->givePermissionTo(['manage stores', 'manage racks', 'manage requests']);
        $brandOwner->givePermissionTo(['manage brands', 'manage products', 'manage rentals']);
    }
}
