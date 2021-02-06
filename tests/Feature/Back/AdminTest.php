<?php

namespace Tests\Feature\Back;

use App\Models\User;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_to_administration_pages()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.dashboard'))
            ->assertSuccessful()
            ->assertViewIs('admin.dashboard');
    }

    /** @test */
    public function a_user_cannot_access_to_administration_pages()
    {
        $user = User::factory()->create([
            'role' => User::USER_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.dashboard'))
            ->assertForbidden();
    }
    
}
