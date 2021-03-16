<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Models\User;
use App\Notifications\Order\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdministrators implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewOrderReceivedEvent  $event
     * @return void
     */
    public function handle(NewOrderReceivedEvent $event)
    {
        Notification::send(User::administrators(), new NewOrderNotification($event->order));
    }
}
