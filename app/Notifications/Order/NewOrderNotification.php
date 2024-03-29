<?php

namespace App\Notifications\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Order $order)
    {
        //
    }

    public function via(User $notifiable): array
    {
        return ['mail', 'database', 'slack'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $userType = $this->order->user ? 'l\'utilisateur' : 'un invité';
        $emaiLAddress = $this->order->email_contact;
        $preOrderMessage = $this->order->has_preorder
            ? "La commande contient un ou plusieurs articles en précommande."
            : "La commande ne contient aucun article en précommande.";

        return (new MailMessage)
                    ->subject("Nouvelle commande sur Beehemiam.fr")
                    ->line('Une nouvelle commande a été passée sur Beehemiam.fr.')
                    ->line(
                        "Pour un montant de {$this->order->formatted_price}€ comprenant
                        {$this->order->orderItems->count()} articles."
                    )
                    ->line("Cette commande a été passée par {$userType} ayant l'adresse email {$emaiLAddress}.")
                    ->line($preOrderMessage)
                    ->action('Aller sur Beehemiam.fr', url('/'));
    }

    public function toArray(User $notifiable): array
    {
        return [
            'event_type' => 'Nouvelle commande',
            'order_amount' => $this->order->formatted_price . '€',
            'order_id' => $this->order->id,
        ];
    }

    public function toSlack(User $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->from('Beehemiam.fr')
            ->image('https://beehemiam.fr/logo-mini-color-2.png')
            ->content(
                "Une nouvelle commande d'un montant de {$this->order->formatted_price}€ a été passée sur Beehemiam.fr."
            );
    }
}
