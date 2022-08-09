<?php

namespace Modules\Partner\Services;

use App\Adapters\Firebase\FirebaseService;
use App\Enums\Guard;
use App\Exceptions\ApiException;
use App\Models\ClientUser;
use App\Notifications\ChannelNotification;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Modules\Partner\Repositories\ClientUserRepository;

class UserService
{
    /** @var ClientUserRepository */
    public ClientUserRepository $userRepository;

    /** @var FirebaseService */
    public FirebaseService $firebaseService;

    /** @var Messaging */
    public Messaging $messaging;

    /**
     * @param ClientUserRepository $userRepository
     * @param Messaging            $messaging
     * @param FirebaseService      $firebaseService
     */
    public function __construct(
        ClientUserRepository $userRepository,
        Messaging            $messaging,
        FirebaseService      $firebaseService
    )
    {
        $this->userRepository = $userRepository;
        $this->messaging = $messaging;
        $this->firebaseService = $firebaseService;
    }

    /**
     * Login service
     *
     * @return void
     */
    public function notify(): void
    {
        try {
            $token = 'dWfCF-kuPcKcKcnAzzBwHZ:APA91bEKmF-9UsIfOXM3Jeh7wwwEUUCfNpsZBes9kCdaw-rC0HTtKhlMl8UCFfhvPH9KD6-jIwDQQhiolGNh0xOVJaztkqietf70ApVhNS57g1LZZRUHATJ-N_pW3KT9mttO-RzUT9Ud';
            // $valid = $this->messaging->validateRegistrationTokens($token);

            $message = CloudMessage::withTarget('token', $token)
                ->withNotification(Notification::create('Title', 'Body'))
                ->withData(['key' => 'value']);

            $this->messaging->send($message);
        } catch (FirebaseException|MessagingException $e) {
            throw ApiException::badRequest($e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function customFcmToken(): string
    {
        $id = auth(Guard::CLIENT->value)->id();

        return $this->firebaseService->customToken(Guard::CLIENT->value . '-' . $id, [
            'type' => Guard::CLIENT->value,
        ]);
    }
}
