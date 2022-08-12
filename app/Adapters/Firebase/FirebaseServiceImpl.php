<?php

namespace App\Adapters\Firebase;

use App\Models\NotificationChannel;
use Illuminate\Database\Eloquent\Collection;
use Kreait\Firebase\Contract\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseServiceImpl implements FirebaseService
{
    /**
     * @var Auth
     */
    public Auth $appAuth;

    /**
     * FirebaseServiceImpl constructor.
     */
    public function __construct()
    {
        $this->appAuth = Firebase::auth();
    }

    /**
     * @inheritDoc
     *
     * @param NotificationChannel $channel
     * @param string              $title
     * @param string              $content
     * @param array               $payload
     * @return void
     */
    public function pushSingleMessage(NotificationChannel $channel, string $title, string $content, array $payload = []): void
    {
        // TODO: Implement pushSingleMessage() method.
    }

    /**
     * @inheritDoc
     *
     * @param Collection $channels
     * @param string     $title
     * @param string     $content
     * @param array      $payload
     * @return void
     */
    public function pushMultipleMessages(Collection $channels, string $title, string $content, array $payload = []): void
    {
        // TODO: Implement pushMultipleMessages() method.
    }
}
