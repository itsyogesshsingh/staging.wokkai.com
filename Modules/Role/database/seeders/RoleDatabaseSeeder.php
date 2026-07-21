<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $roles = [
            'root' => 'all',
            'HR Manager'  => ['employees', 'attendance', 'leave_management'],
            'Sales Manager'=> ['leads', 'customers', 'quotes'],
            'Support Agent'=> ['support_tickets'],
        ];

        foreach ($roles as $roleName => $modules) {

            if ($roleName === 'root' && Role::where('name', 'root')->exists()) {
                $role = Role::where('name', 'root')->first();
                $role->syncPermissions(Permission::all());
                continue;
            }

            $role = Role::updateOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            if ($modules === 'all') {
                $role->syncPermissions(Permission::all());
                continue;
            }

            $permissions = [];
            foreach ($modules as $module) {
                $permissions = array_merge(
                    $permissions,
                    Permission::where('name', 'like', $module . '.%')->pluck('name')->toArray()
                );
            }

            $role->syncPermissions($permissions);
        }
    }
}
