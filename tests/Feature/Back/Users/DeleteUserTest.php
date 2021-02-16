<?php

namespace Tests\Feature\Back\Users;

use App\Models\User;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_delete_a_user()
    {
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $user = User::factory()->create();
        $userCount = User::count();

        $this->followingRedirects()->delete(route('admin.users.destroy', $user))
            ->assertSuccessful();

        $this->assertCount($userCount - 1, User::all());
    }
    
    /** @test */
    public function an_admin_cannot_delete_an_admin()
    {
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $userCount = User::count();

        $this->delete(route('admin.users.destroy', $admin))
            ->assertForbidden();

        $this->assertCount($userCount, User::all());
    }
    
}
