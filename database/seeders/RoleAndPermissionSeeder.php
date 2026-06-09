<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        $permissions = [
            'manage-tenants',
            'manage-products',
            'manage-users',
            'manage-branches',
            'make-sales',
            'view-reports',
            'manage-warehouse',
            'manage-vendors',
            'manage-customers',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $owner      = Role::firstOrCreate(['name' => 'owner']);
        $manager    = Role::firstOrCreate(['name' => 'manager']);
        $cashier    = Role::firstOrCreate(['name' => 'cashier']);

        // Assign permissions to roles
        $owner->syncPermissions($permissions); // ເຫັນທຸກຢ່າງ
        $manager->syncPermissions([
            'manage-products', 'make-sales',
            'view-reports', 'manage-warehouse',
            'manage-customers',
        ]);
        $cashier->syncPermissions(['make-sales', 'manage-customers']);
        $superAdmin->syncPermissions($permissions);
    }
}