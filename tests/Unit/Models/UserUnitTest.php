<?php

namespace Tests\Unit\Models;

use App\Models\Address;
use App\Models\User;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    /** @test */
    public function a_user_has_property_is_admin()
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->is_admin);
    }

    /** @test */
    public function an_admin_has_property_is_admin_to_true()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);

        $this->assertTrue($user->is_admin);
    }
    
    /** @test */
    public function a_user_has_a_property_full_name()
    {
        $user = User::factory()->create();

        $this->assertEquals(ucfirst($user->firstname) . ' ' . ucfirst($user->lastname), $user->full_name);
    }
    
    /** @test */
    public function a_user_has_a_property_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($address->id, $user->address->id);
    }
}
