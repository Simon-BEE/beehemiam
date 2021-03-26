<?php

namespace App\Repositories\ContactMessage;

use App\Mail\Contact\ReplyContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactRepository
{
    public function reply(ContactMessage $message, string $content): void
    {
        if ($message->reply) {
            throw new \Exception("Impossible de répondre à nouveau à ce message", 1);
        }

        $reply = $message->reply()->create([
            'email' => config('beehemiam.contact.email'),
            'object' => 'Re: ' . $message->object,
            'content' => $content,
        ]);

        Mail::to($message->email)->send(new ReplyContactMessageMail($reply));
    }
}
