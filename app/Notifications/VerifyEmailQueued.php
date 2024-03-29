<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class VerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject("Vérification de l'adresse email")
            ->line("Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse email :")
            ->action("Vérfier l'adresse email", $url)
            ->line("Si vous n'avez pas créé de compte, vous pouvez ignorer ce message.")
            ->line(
                "Si vous aviez déjà un compte et n'êtes pas à l'origine de cette démarche, 
                veuillez contacter un administrateur à cette adresse email contact@beehemiam.fr 
                ou depuis le formulaire de contact sur beehemiam.fr."
            );
    }
}
