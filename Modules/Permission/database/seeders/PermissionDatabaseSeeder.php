<?php

namespace Modules\Permission\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = DB::table('saas_modules')->get();
        $actions = ['create', 'edit', 'delete', 'view'];

        foreach ($modules as $module) {

            $moduleName = Str::snake($module->module_name);

            foreach ($actions as $action) {

                $permission = $action . '_' . $moduleName;

                DB::table('permissions')->updateOrInsert(
                    [
                        'name' => $permission,
                        'guard_name' => 'web',
                    ],
                    [
                        'slug' => $permission,
                        'module_id' => $module->module_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
