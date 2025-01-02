<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        // System Logs
        Permission::create(['name' => 'view-logs']);
        Permission::create(['name' => 'create-logs']);
        Permission::create(['name' => 'view-any-logs']);
        Permission::create(['name' => 'view-own-logs']);
        Permission::create(['name' => 'export-logs']);

        // Create fundamental roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        
        // Super Admin gets all permissions
        $superAdmin->givePermissionTo(Permission::all());

        // Create student, teacher, parent, admin, staff roles
        $student = Role::create(['name' => 'student']);
        $teacher = Role::create(['name' => 'teacher']);
        $parent = Role::create(['name' => 'parent']);
        $admin = Role::create(['name' => 'admin']);
    }
}