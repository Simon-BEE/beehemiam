<?php

namespace Tests\Feature\User;

use App\Mail\Users\DeleteAccountMail;
use App\Mail\Users\UserAccountDeletedMail;
use App\Models\User;
use App\Notifications\ExportPersonnalDataNotification;
use App\Notifications\SimpleAdminNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    /** @test */
    public function a_user_can_see_personnal_settings_page()
    {
        $this->signIn();

        $this->get(route('user.settings.index'))
            ->assertSuccessful()
            ->assertViewIs('user.settings');
    }
    
    /** @test */
    public function a_user_can_ask_to_get_his_personnal_data()
    {
        Notification::fake();
        $user = $this->signIn();

        $this->followingRedirects()->post(route('user.settings.personnal-data'))
            ->assertSuccessful();

        Notification::assertSentTo($user, ExportPersonnalDataNotification::class);
    }
    
    /** @test */
    public function a_user_can_ask_to_delete_his_account()
    {
        Mail::fake();
        $user = $this->signIn();

        $this->followingRedirects()->post(route('user.settings.email-delete-account'))
            ->assertSuccessful();

        $this->assertEquals(
            $user->email, 
            \DB::table('delete_users')->where('email', $user->email)->whereNull('deleted_at')->value('email')
        );

        $this->assertNull(
            \DB::table('delete_users')->where('email', $user->email)->whereNull('deleted_at')->value('deleted_at')
        );

        Mail::assertQueued(DeleteAccountMail::class);
    }
    
    /** @test */
    public function a_user_can_delete_his_account()
    {
        Mail::fake();
        Notification::fake();
        $user = $this->signIn();

        $this->followingRedirects()->post(route('user.settings.email-delete-account'))
            ->assertSuccessful();

        $this->followingRedirects()->get(route('user.settings.delete-account', $user))
            ->assertSuccessful();

        $this->assertNotNull(
            \DB::table('delete_users')->where('email', $user->email)->value('email')
        );
        Notification::assertSentTo(User::where('role', User::ADMIN_ROLE)->get(), SimpleAdminNotification::class);
        $this->assertFalse(auth()->check());
        Mail::assertQueued(UserAccountDeletedMail::class);
    }
    
}
