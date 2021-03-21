<?php

namespace Tests\Feature\Pages;

use App\Mail\MessageFromContactMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /** @test */
    public function a_visitor_can_see_contact_page()
    {
        $this->get(route('contact.index'))
            ->assertSuccessful()
            ->assertViewIs('pages.contact');
    }

    /** @test */
    public function a_visitor_can_send_a_message_from_contact_page()
    {
        Mail::fake();

        $this->followingRedirects()->post(route('contact.send'))
            ->assertSuccessful();

        Mail::assertQueued(MessageFromContactMail::class);
    }
}
