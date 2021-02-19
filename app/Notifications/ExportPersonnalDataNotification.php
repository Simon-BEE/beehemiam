<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExportPersonnalDataNotification extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /** @var string */
    public $zipFilename;

    /** @var \Illuminate\Support\Carbon */
    public $deletionDatetime;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $zipFilename)
    {
        $this->zipFilename = $zipFilename;

        $this->deletionDatetime = now()->addDays(config('personal-data-export.delete_after_days'));
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $downloadUrl = route('personal-data-exports', $this->zipFilename);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $downloadUrl);
        }

        return (new MailMessage)
            ->subject('Téléchargement de vos données personnelles')
            ->line("Veuillez cliquer sur le bouton ci-dessous pour télécharger le fichier zip contenant toutes vos données enregistrées sur Beehemiam.fr.")
            ->action("Télécharger mes données", $downloadUrl)
            ->line("Le fichier sera supprimé à la date suivante : " . $this->deletionDatetime->format('d/m/Y à H:i') . '.');
    }

    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
