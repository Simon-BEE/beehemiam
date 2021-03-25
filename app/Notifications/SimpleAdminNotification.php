<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SimpleAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public string $eventType)
    {
        //
    }

    public function via(User $notifiable): array
    {
        return ['mail', 'database', 'slack'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Information importante sur Beehemiam.fr")
                    ->line('Une nouvelle activité importante a été détectée sur le site Beehemiam.fr')
                    ->line($this->eventType)
                    ->action('Aller sur Beehemiam.fr', url('/'));
    }

    public function toArray(User $notifiable): array
    {
        return [
            'event_type' => $this->eventType,
        ];
    }

    public function toSlack(User $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->from('Beehemiam.fr')
            ->image('https://beehemiam.fr/logo-mini-color-2.png')
            ->content(
                "Une nouvelle activité importante a été détectée sur le site Beehemiam.fr. {$this->eventType}"
            );
    }
}
