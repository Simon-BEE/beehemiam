<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_has_access_to_his_dashboard()
    {
        $this->signIn();

        $this->get(route('user.dashboard'))
            ->assertSuccessful()
            ->assertViewIs('user.dashboard');
    }

    /** @test */
    public function a_guest_has_not_access_to_dashboard()
    {
        $this->get(route('user.dashboard'))
            ->assertRedirect();
    }
    
}
