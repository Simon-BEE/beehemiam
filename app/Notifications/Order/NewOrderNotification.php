<?php

namespace App\Notifications\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
        return ['mail', 'database'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $userType = $this->order->user ? 'l\'utilisateur' : 'un invité';
        $emaiLAddress = get_client_email();
        $preOrderMessage = $this->order->has_preorder
            ? "La commande contient un ou plusieurs articles en précommande."
            : "La commande ne contient aucun article en précommande.";

        return (new MailMessage)
                    ->subject("Nouvelle commande sur Beehemiam.fr")
                    ->line('Une nouvelle commande a été passée sur Beehemiam.fr.')
                    ->line("Pour un montant de {$this->order->formatted_price}€ comprenant {$this->order->orderItems->count()} articles.")
                    ->line("Cette commande a été passée par {$userType} ayant l'adresse email {$emaiLAddress}.")
                    ->line($preOrderMessage)
                    ->action('Aller sur Beehemiam.fr', url('/'));
    }

    public function toArray(User $notifiable): array
    {
        return [
            'order_amount' => $this->order->formatted_price . '€',
        ];
    }
}
