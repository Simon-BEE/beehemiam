<?php

namespace App\Listeners\Contact;

use App\Events\FormContactMessageSend;
use App\Models\ContactMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMessageInDatabase implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  FormContactMessageSend  $event
     * @return void
     */
    public function handle(FormContactMessageSend $event)
    {
        ContactMessage::create([
            'email' => $event->email,
            'object' => $event->object,
            'content' => $event->content,
        ]);
    }
}
