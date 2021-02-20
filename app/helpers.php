<?php

use App\Models\User;
use App\Notifications\SimpleAdminNotification;
use Illuminate\Support\Facades\Notification;

if (!function_exists('notify_administrators')) {
    function notify_administrators(string $eventType): void
    {
        Notification::send(
            User::administrators(),
            new SimpleAdminNotification($eventType)
        );
    }
}
