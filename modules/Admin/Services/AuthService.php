<?php

namespace Modules\Admin\Services;

use App\Exceptions\ApiException;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\DTOs\AuthResponse;
use Modules\Admin\Repositories\Parameters\AuthLoginParam;

class AuthService
{
    /**
     * Login service
     *
     * @param AuthLoginParam $param
     * @return AuthResponse
     */
    public function login(AuthLoginParam $param): AuthResponse
    {
        /** @var Admin $admin */
        $admin = Admin::query()->where('email', $param->email)->first();

        if (!$admin || !Hash::check($param->password, $admin->password)) {
            throw ApiException::forbidden(__('auth.failed'));
        }

        $token = $admin->createToken($param->device_name)->plainTextToken;

        return new AuthResponse($token);
    }

    /**
     * Logout service
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
