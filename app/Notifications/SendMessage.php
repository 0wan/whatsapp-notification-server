<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Webhook\WebhookChannel;
use NotificationChannels\Webhook\WebhookMessage;

class SendMessage extends Notification
{
    use Queueable;

    /**
     * The POST data of the Webhook request.
     *
     * @var mixed
     */
    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phone, $message = '')
    {
        $this->data = [
            'phone' => $phone,
            'message' => $message
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebhookChannel::class];
    }

    /**
     * Get the Message representation of the notification.
     *
     * @param mixed $notifiable
     */
    public function toWebhook($notifiable)
    {
        return WebhookMessage::create($this->data)
            // ->header('Authorization', 'Bearer ...')
            ->header('Content-Type', 'application/json');
    }
}
