<?php

namespace App\Listeners\Users;

use App\Events\PasswordEdited;
use App\Mail\Users\PasswordHasChangedMail;
use Illuminate\Support\Facades\Mail;

class PasswordHasChanged
{
    /**
     * Handle the event.
     *
     * @param  PasswordEdited  $event
     * @return void
     */
    public function handle(PasswordEdited $event)
    {
        Mail::to($event->user)->send(new PasswordHasChangedMail($event->user));
    }
}
