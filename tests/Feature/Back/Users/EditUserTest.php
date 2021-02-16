<?php

namespace Tests\Feature\Back\Users;

use App\Mail\Users\PasswordHasChangedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_user_edit_form()
    {
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $user = User::factory()->create();

        $this->get(route('admin.users.edit', $user))
            ->assertSuccessful()
            ->assertViewIs('admin.users.edit')
            ->assertSee($user->name);
    }

    /** @test */
    public function an_admin_can_edit_a_user()
    {
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $user = User::factory()->create(['firstname' => 'Paul']);

        $this->followingRedirects()->patch(route('admin.users.update', $user), [
            'firstname' => 'Jacques',
            'lastname' => $user->lastname,
            'email' => $user->email,
            'newsletter' => $user->newsletter,
        ])
            ->assertSuccessful();

        $this->assertEquals('Jacques', $user->fresh()->firstname);
    }

    /** @test */
    public function an_admin_can_edit_a_password_user()
    {
        Mail::fake();

        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $user = User::factory()->create(['password' => '123123']);

        $this->followingRedirects()->patch(route('admin.users.update.password', $user), [
            'password' => '12341234',
        ])
            ->assertSuccessful();

        $this->assertTrue(password_verify('12341234', $user->fresh()->password));
        Mail::assertQueued(PasswordHasChangedMail::class);
    }
    
    // edit password
    // set as admin
}
