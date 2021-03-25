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

    /** @test */
    public function helper_unformat_amount()
    {
        $amount1 = 145.95;
        $amount2 = 145;
        $amount3 = 132.15;

        $this->assertEquals(14595, unformat_amount($amount1));
        $this->assertEquals(14500, unformat_amount($amount2));
        $this->assertEquals(13215, unformat_amount($amount3));
    }
}
