<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::updateOrCreate(['name' => 'root', 'guard_name' => 'web']);
        $user = User::updateOrCreate(
            ['email' => 'root@admin.com'],
            [
                'username' => 'username',
                'password' => 'password',
                'status' => 'active'
            ]
        );
        $user->assignRole($role);
    }
}
