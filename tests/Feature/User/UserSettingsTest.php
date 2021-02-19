<?php

namespace Tests\Feature\User;

use Illuminate\Support\Facades\Mail;
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
        Mail::fake();
        $this->signIn();

        $this->followingRedirects()->post(route('user.settings.personnal-data'))
            ->assertSuccessful();

        Mail::assertQueued(ExportPersonnalDataMail::class);
    }
    
}
