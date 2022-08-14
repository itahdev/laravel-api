<?php

namespace Modules\Partner\Services;

use App\Enums\SocialProviderType;
use App\Enums\UserStatus;
use App\Exceptions\ApiException;
use App\Models\ClientUser;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Facades\Socialite;
use Modules\Partner\DTOs\AuthResponse;
use Modules\Partner\Http\Requests\LoginSocialRequest;
use Modules\Partner\Repositories\Parameters\AuthLoginParam;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

        /** @var ClientUser $user */
        $user = Auth::user();
        if (!$user || $user->status === UserStatus::INACTIVE) {
            throw ApiException::forbidden(trans('exceptions.account_inactive'));
        }

        return new AuthResponse($token);
    }

    /**
     * @param LoginSocialRequest $request
     * @param string             $provider
     * @return array
     */
    public function socialLogin(LoginSocialRequest $request, string $provider): array
    {
        return [$this->socialUser($provider)];
    }

    /**
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirect(string $provider): RedirectResponse
    {
        $socialite = Socialite::driver($provider);

        return $socialite->stateless()->redirect();
    }

    /**
     * Logout service
     *x
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Get user profile
     *
     * @param string $provider
     * @return AbstractUser
     */
    private function socialUser(string $provider): AbstractUser
    {
        $socialite = Socialite::driver($provider);

        return $socialite->stateless()->user();
    }
}
