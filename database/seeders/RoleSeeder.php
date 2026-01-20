<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define Permissions
        $permissions = [
            // Dashboard
            'view dashboard',
            
            // Data Operations
            'view data',
            'create data',
            'edit own data',
            'edit all data',
            'delete data',
            
            // System Management
            'manage systems', // Create/Edit Modules
            
            // User Management
            'manage users', // CRUD Users
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Define Roles and Assign Permissions

        // Role: User (Auditor/Guest)
        // Deskripsi: Read-Only.
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $userRole->syncPermissions([
            'view dashboard',
            'view data'
        ]);

        // Role: SuperUser (Staff/Operator)
        // Deskripsi: Input Terbatas (Scoped Write).
        $superUserRole = Role::firstOrCreate(['name' => 'SuperUser']);
        $superUserRole->syncPermissions([
            'view dashboard',
            'view data',
            'create data',
            'edit own data'
        ]);

        // Role: Supervisor (Manager)
        // Deskripsi: Full Control Modul.
        $supervisorRole = Role::firstOrCreate(['name' => 'Supervisor']);
        $supervisorRole->syncPermissions([
            'view dashboard',
            'view data',
            'create data',
            'edit all data',
            'delete data',
            'manage systems'
        ]);

        // Role: Admin (IT Support)
        // Deskripsi: System Admin.
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions([
            'view dashboard',
            'view data',
            'edit all data',
            'delete data',
            'manage systems',
            'manage users'
        ]);
    }
}
