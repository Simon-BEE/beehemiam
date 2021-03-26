<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class NewsletterTest extends TestCase
{
    /** @test */
    public function a_visitor_can_subscribe_to_newsletter()
    {
        $this->assertDatabaseCount('newsletters', 0);

        $this->post(route('api.newsletter.subscribe'), [
            'email' => 'email@email.net',
            ])
            ->assertSuccessful();

        $this->assertDatabaseCount('newsletters', 1);
    }

}
