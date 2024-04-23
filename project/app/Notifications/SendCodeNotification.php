<?php

namespace App\Notifications;

use app\Enums\ServiceType;
use App\Services\Notifications\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class SendCodeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly ServiceType $type,
        private readonly string $code
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [$this->type->name];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(sprintf('Код подтверждения: %s', $this->code));
    }

    /**
     * Get the telegram message representation of the notification.
     */
    public function toTelegram(object $notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->getTelegramChatId())
            ->content(sprintf('Код подтверждения: %s', $this->code));
    }

    /**
     * Get the sms message representation of the notification
     */
    public function toSms(object $notifiable)
    {
        return SMSMessage::create()
            ->to($notifiable->getPhone())
            ->line(sprintf('Код подтверждения: %s', $this->code));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
