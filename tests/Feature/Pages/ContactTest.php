<?php

namespace Tests\Feature\Pages;

use App\Mail\Contact\CopyMessageFromContactMail;
use App\Mail\Contact\MessageFromContactMail;
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

        $this->followingRedirects()->post(route('contact.send'), [
            'email' => 'example@example.net',
            'object' => 'Prise de contact',
            'content' => 'Voici un message envoyé depuis le formulaire',
            'terms' => 1,
        ])
            ->assertSuccessful();

        Mail::assertQueued(MessageFromContactMail::class);
    }

    /** @test */
    public function a_visitor_get_a_copy_of_sent_message_from_contact_page()
    {
        Mail::fake();

        $this->followingRedirects()->post(route('contact.send'), [
            'email' => 'example@example.net',
            'object' => 'Prise de contact',
            'content' => 'Voici un message envoyé depuis le formulaire',
            'terms' => 1,
        ])
            ->assertSuccessful();

        Mail::assertQueued(MessageFromContactMail::class);
        Mail::assertQueued(CopyMessageFromContactMail::class);
    }

    /** @test */
    public function when_a_person_send_a_message_an_entry_in_database_is_saved()
    {
        $this->assertDatabaseCount('contact_messages', 0);

        $this->followingRedirects()->post(route('contact.send'), [
            'email' => 'example@example.net',
            'object' => 'Prise de contact',
            'content' => 'Voici un message envoyé depuis le formulaire',
            'terms' => 1,
            ])
            ->assertSuccessful();

        $this->assertDatabaseCount('contact_messages', 1);
    }
}
