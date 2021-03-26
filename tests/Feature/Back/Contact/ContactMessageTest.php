<?php

namespace Tests\Feature\Back\Contact;

use App\Mail\Contact\ReplyContactMessageMail;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_all_contact_messages()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        ContactMessage::factory()->count(10)->create();

        $this->get(route('admin.messages.index'))
            ->assertSuccessful()
            ->assertViewIs('admin.messages.index');
    }

    /** @test */
    public function an_admin_can_see_a_message()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $message = ContactMessage::factory()->create();

        $this->get(route('admin.messages.show', $message))
            ->assertSuccessful()
            ->assertViewIs('admin.messages.show');
    }

    /** @test */
    public function when_an_admin_open_message_for_the_first_time_is_set_to_read()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $message = ContactMessage::factory()->create();

        $this->assertNull($message->read_at);

        $this->get(route('admin.messages.show', $message))
            ->assertSuccessful()
            ->assertViewIs('admin.messages.show');


        $this->assertNotNull($message->fresh()->read_at);
    }

    /** @test */
    public function an_admin_can_reply_to_a_message()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $message = ContactMessage::factory()->create();

        $this->followingRedirects()->post(route('admin.messages.reply', $message), [
            'content' => 'Réponse au message',
        ])
            ->assertSuccessful();


        $this->assertEquals($message->reply()->value('content'), 'Réponse au message');
    }

    /** @test */
    public function when_an_admin_reply_to_a_message_an_email_is_sent()
    {
        Mail::fake();
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $message = ContactMessage::factory()->create();

        $this->followingRedirects()->post(route('admin.messages.reply', $message), [
            'content' => 'Réponse au message',
        ])
            ->assertSuccessful();


        Mail::assertQueued(ReplyContactMessageMail::class);
    }
}
