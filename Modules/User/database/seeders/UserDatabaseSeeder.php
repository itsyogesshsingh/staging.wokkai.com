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

        if ($roles->isEmpty()) {
            $this->command->warn('No roles found. Skipping role assignment.');
        }

        for ($i = 0; $i < $total; $i += $chunkSize) {
            $users = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $num = $i + $j;
                if ($num >= $total) {
                    break;
                }

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

            User::upsert(
                $users,
                ['email'],
                ['first_name', 'last_name', 'username', 'password', 'updated_at']
            );

            $insertedUsers = User::whereIn('email', array_column($users, 'email'))->get();
            if ($roles->isNotEmpty()) {
                foreach ($insertedUsers as $user) {
                    $user->syncRoles($roles->random()->name);
                }
            }
        }
    }
}
