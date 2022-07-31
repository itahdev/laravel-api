<?php

namespace Modules\Partner\Services;

use App\Enums\UserStatus;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Auth;
use Modules\Partner\DTOs\AuthResponse;
use Modules\Partner\Repositories\Parameters\AuthLoginParam;

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
        $token = Auth::attempt($param->toArray());
        if (!$token) {
            throw ApiException::forbidden(__('auth.failed'));
        }

        $user = Auth::user();
        if (!$user || $user->status === UserStatus::INACTIVE) {
            throw ApiException::forbidden(trans('exceptions.account_inactive'));
        }

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
