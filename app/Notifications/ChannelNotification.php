<?php

namespace App\Notifications;

use App\Models\ClientUser;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Client\Response;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class ChannelNotification extends Notification
{
    use Queueable;

    protected string $token;
    protected ?string $message;
    protected ?string $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        string  $token,
        ?string $message = null,
        ?string $title = null,
    )
    {
        $this->token = $token;
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param ClientUser $notifiable
     * @return array
     */
    public function via(ClientUser $notifiable): array
    {
        return ['firebase'];
    }

    /**
     * @param ClientUser $notifiable
     * @return Response
     */
    public function toFirebase(ClientUser $notifiable): Response
    {
        return (new FirebaseMessage)
            ->withTitle($this->title)
            ->withBody($this->message)
            ->withPriority('high')
            ->asMessage($this->token);
    }
}
