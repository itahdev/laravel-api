<?php

namespace Modules\Partner\Services;

use App\Notifications\ChannelNotification;
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
     * @return void
     */
    public function singleNotify(int $userId, ?string $message = null): void
    {
        $user = $this->userRepository->findOrFailById($userId);
        $token = $user->channel->fcm_token;

        $user->notify(new ChannelNotification($token, $token));
    }
}
