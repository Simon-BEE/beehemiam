<?php

namespace Tests\Unit;

use App\Models\User;
use App\Notifications\SimpleAdminNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    /** @test */
    public function a_notification_can_be_send_easily_to_administrators()
    {
        Notification::fake();

        notify_administrators('Nouvelle notification destiné aux administrateurs du site');

        Notification::assertSentTo(User::administrators()->get(), SimpleAdminNotification::class);
    }
}
