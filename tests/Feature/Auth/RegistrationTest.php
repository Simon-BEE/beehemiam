<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/inscription');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register_if_terms_are_accepted()
    {
        $response = $this->post('/inscription', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'newsletter' => 1,
            'terms' => 1,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_cannot_register_if_terms_are_not_accepted()
    {
        $response = $this->post('/inscription', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'newsletter' => 1,
            'terms' => 0,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['terms']);
    }
}
