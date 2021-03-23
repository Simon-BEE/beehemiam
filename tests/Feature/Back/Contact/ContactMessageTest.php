<?php

namespace Tests\Feature\Back\Contact;

use App\Models\ContactMessage;
use App\Models\User;
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

}
