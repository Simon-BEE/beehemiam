<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_has_access_to_his_dashboard()
    {
        $this->signIn();

        $this->get(route('user.profile.dashboard'))
            ->assertSuccessful()
            ->assertViewIs('user.dashboard');
    }

    /** @test */
    public function a_guest_has_not_access_to_dashboard()
    {
        $this->get(route('user.profile.dashboard'))
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

    /** @test */
    public function a_user_can_ask_to_receive_a_new_email_verification()
    { 
        Notification::fake();
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $this->signIn($user);
        
        $this->followingRedirects()->post(route('user.profile.email-verification'))
            ->assertSuccessful();

        Notification::assertSentTo($user, VerifyEmailQueued::class);
    }

    /** @test */
    public function a_user_can_see_edit_personnal_information_form()
    {
        $this->signIn();

        $this->get(route('user.profile.edit'))
            ->assertSuccessful()
            ->assertViewIs('user.edit');
    }

    /** @test */
    public function a_user_can_edit_personnal_information()
    {
        $user = User::factory()->create([
            'firstname' => 'Jean',
            'email' => 'jeannot@example.net',
        ]);
        $this->signIn($user);

        $this->followingRedirects()->patch(route('user.profile.update', [
            'firstname' => 'Marc',
            'lastname' => 'Jacques',
            'email' => 'jeannot@example.net',
        ]))
            ->assertSuccessful();

        $this->assertEquals('Marc', $user->fresh()->firstname);
    }

    /** @test */
    public function if_a_user_edit_his_email_address_then_he_needs_to_verify_this_one()
    {
        Notification::fake();
        $user = User::factory()->create([
            'firstname' => 'Marc',
            'lastname' => 'Jacques',
            'email' => 'jeannot@example.net',
        ]);
        $this->signIn($user);

        $this->followingRedirects()->patch(route('user.profile.update', [
            'firstname' => 'Marc',
            'lastname' => 'Jacques',
            'email' => 'marc@example.net',
        ]))
            ->assertSuccessful();

        $this->assertEquals('marc@example.net', $user->fresh()->email);
        $this->assertNull($user->fresh()->email_verified_at);
        Notification::assertSentTo($user, VerifyEmailQueued::class);
    }

    /** @test */
    public function a_user_can_see_edit_password_form()
    {
        $this->signIn();

        $this->get(route('user.profile.edit.password'))
            ->assertSuccessful()
            ->assertViewIs('user.password');
    }

    /** @test */
    public function a_user_can_edit_his_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        $this->signIn($user);

        $this->followingRedirects()->patch(route('user.profile.update.password', [
            'old_password' => 'password',
            'password' => 'nouveau-mot-de-passe',
            'password_confirmation' => 'nouveau-mot-de-passe',
        ]))
            ->assertSuccessful();

        $this->assertTrue(password_verify('nouveau-mot-de-passe', $user->fresh()->password));
    }
}
