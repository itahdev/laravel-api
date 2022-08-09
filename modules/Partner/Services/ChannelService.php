<?php

namespace Modules\Partner\Services;

use Modules\Partner\DTOs\AuthResponse;
use Modules\Partner\Repositories\ClientUserRepository;

class ChannelService
{
    /** @var ClientUserRepository */
    public ClientUserRepository $userRepository;

    public function __construct(ClientUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Login service
     *
     * @param int         $userId
     * @param string|null $message
     * @return AuthResponse
     */
    public function singleNotify(int $userId, ?string $message = null): AuthResponse
    {
        $user = $this->userRepository->findOrFailById($userId);
        $token = $user->channel->fcm_token;
        dd($token);
    }
}
