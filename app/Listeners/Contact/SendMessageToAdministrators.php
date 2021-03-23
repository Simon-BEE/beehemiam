<?php

namespace App\Listeners\Contact;

use App\Events\FormContactMessageSend;
use App\Mail\Contact\MessageFromContactMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendMessageToAdministrators
{
    /**
     * Handle the event.
     *
     * @param  FormContactMessageSend  $event
     * @return void
     */
    public function handle(FormContactMessageSend $event)
    {
        Mail::to(User::administrators()->get())
            ->send(new MessageFromContactMail($event->email, $event->object, $event->content));
    }
}
