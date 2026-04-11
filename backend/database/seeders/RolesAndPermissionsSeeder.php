<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'tasks.view',
            'tasks.manage',
            'teams.view',
            'teams.manage',
            'users.view',
            'users.manage',
            'workflows.view',
            'workflows.manage',
            'reports.view',
            'settings.manage',
            'templates.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'api');
        }

        $adminRole = Role::findOrCreate(RoleName::Admin->value, 'api');
        $userRole = Role::findOrCreate(RoleName::User->value, 'api');

        $adminRole->syncPermissions($permissions);
        $userRole->syncPermissions([
            'dashboard.view',
            'tasks.view',
        ]);
    }
}
