<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Modules\Permission\Database\Seeders\PermissionDatabaseSeeder::class,
            \Modules\Role\Database\Seeders\RoleDatabaseSeeder::class,
            \Modules\User\Database\Seeders\UserDatabaseSeeder::class,
        ]);
    }
}
