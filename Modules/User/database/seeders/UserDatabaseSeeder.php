<?php

namespace Modules\User\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = 1000;
        $chunkSize = 500;

        $hashedPassword = bcrypt('password');
        $roles = Role::all();

        for ($i = 0; $i < $total; $i += $chunkSize) {
            $users = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $num = $i + $j;
                $users[] = [
                    'first_name' => "first {$num}",
                    'last_name'  => "last {$num}",
                    'username'   => "user{$num}",
                    'email'      => "user{$num}@test.com",
                    'password'   => $hashedPassword,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            User::insert($users);
            // $insertedUsers = User::query()->whereIn('email', array_column($users, 'email'), 'and', false)->get();
            $insertedUsers = User::query()->whereIn('email', array_column($users, 'email'), '=', true)->get();
            foreach ($insertedUsers as $user) {
                $user->assignRole($roles->random()->name);
            }
        }
    }
}
