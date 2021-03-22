<?php

namespace App\Listeners\Contact;

use App\Events\FormContactMessageSend;
use App\Mail\Contact\CopyMessageFromContactMail;
use Illuminate\Support\Facades\Mail;

class SendMessageCopyToAuthor
{
    /**
     * Handle the event.
     *
     * @param  FormContactMessageSend  $event
     * @return void
     */
    public function handle(FormContactMessageSend $event)
    {
        Mail::to($event->email)
            ->send(new CopyMessageFromContactMail($event->email, $event->object, $event->content));
    }
}
