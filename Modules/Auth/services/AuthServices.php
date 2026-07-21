<?php
namespace Modules\Auth\services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class AuthServices
{
    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {

            return [
                'status' => false,
                'message' => 'Invalid username or password'
            ];
        }

        request()->session()->regenerate();

        $user = Auth::user();

        return [
            'status' => true,
            'message' => 'Login successful',
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
            'user' => [
                'uid' => $user->uid,
                'username' => $user->username,
                'email' => $user->email,
            ]
        ];
    }

    public function setPassword(string $token, array $data): array
    {
        $email = DB::table('password_reset_tokens')->where('token', $token)->first()->email ?? null;
        $status = Password::reset([
            'email' => $email,
            'token' => $token,
            'password' => $data['password'],
            // 'password_confirmation' => $data['password_confirmation'],
        ], function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($status === Password::PASSWORD_RESET) {
            return [
                'status' => true,
                'message' => 'Password set successfully'
            ];
        }

        return [
            'status' => false,
            'message' => __($status)
        ];
    }

    public function logout(): array
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return ['status' => true, 'message' => 'Logout successful'];
    }
}
