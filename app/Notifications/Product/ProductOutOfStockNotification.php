<?php

namespace App\Notifications\Product;

use App\Models\ProductOptionSize;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductOutOfStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Model $productOption)
    {
        //
    }

    public function via(User $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $size = $this->productOption instanceof ProductOptionSize
            ? 'en taille ' . $this->productOption->size->name
            : '';

        return (new MailMessage)
                    ->subject("Produit en rupture de stock sur Beehemiam.fr")
                    ->line('Un produit vient d\'être en rupture de stock.')
                    ->line(
                        "Il s'agit de {$this->productOption->productOption->name}
                        qui ne possède plus d'exemplaire {$size} en vente."
                    )
                    ->line("Identifiant du produit : {$this->productOption->productOption->id}")
                    ->action('Aller sur Beehemiam.fr', url('/'));
    }

    public function toArray(User $notifiable): array
    {
        return [
            'event_type' => 'Produit en rupture de stock',
            'product_option_id' => $this->productOption->productOption->id,
            'size_id' => $this->productOption instanceof ProductOptionSize
                ? $this->productOption->size->id
                : null,
        ];
    }
}
