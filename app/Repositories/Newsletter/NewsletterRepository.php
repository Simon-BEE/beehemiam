<?php

namespace App\Repositories\Newsletter;

use App\Exceptions\UserAlreadySubscribedException;
use App\Models\Newsletter;
use App\Models\User;

class NewsletterRepository
{
    public function save(string $email): void
    {
        if (User::where('newsletter', true)->whereEmail($email)->exists() || Newsletter::whereEmail($email)->exists()) {
            throw new UserAlreadySubscribedException("Cette adresse email est déjà inscrite à la newsletter !", 1);
        }

        Newsletter::create([
            'email' => $email,
        ]);
    }
}
