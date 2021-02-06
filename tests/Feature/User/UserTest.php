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

    /** @test */
    public function a_user_has_his_last_activity_datetime_saved_each_five_minutes()
    {
        $user = $this->signIn();
        $dateIn6minutes = now()->addMinutes(5);

        $this->travelTo($dateIn6minutes);

        $this->get('/');

        $this->assertTrue(
                $user->fresh()->last_activity_at->startOfMinute()
                    ->greaterThanOrEqualTo(
                        $dateIn6minutes->startOfMinute()
                    )
        );
    }
    
    
}
