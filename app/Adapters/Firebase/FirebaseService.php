<?php

namespace App\Adapters\Firebase;

use App\Models\NotificationChannel;
use Illuminate\Database\Eloquent\Collection;

interface FirebaseService
{
    /**
     * Push single message.
     *
     * @param NotificationChannel $channel
     * @param string              $title
     * @param string              $content
     * @param array               $payload
     * @return void
     */
    public function pushSingleMessage(NotificationChannel $channel, string $title, string $content, array $payload = []): void;

    /**
     * Push multiple message
     *
     * @param Collection $channels
     * @param string $title
     * @param string $content
     * @param array $payload
     * @return void
     */
    public function pushMultipleMessages(Collection $channels, string $title, string $content, array $payload = []): void;
}
