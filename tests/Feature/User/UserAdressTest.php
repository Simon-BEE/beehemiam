<?php

namespace Tests\Feature\User;

use App\Models\Address;
use App\Models\Country;
use Tests\TestCase;

class UserAdressTest extends TestCase
{
    /** @test */
    public function a_user_can_see_address_form()
    {
        $this->signIn();

        $this->get(route('user.addresses.create'))
            ->assertSuccessful()
            ->assertViewIs('user.addresses.create')
            ->assertSee(Country::inRandomOrder()->first()->name)    
        ;
    }

    /** @test */
    public function a_user_can_create_a_new_address()
    {
        $user = $this->signIn();

        $this->followingRedirects()->post(route('user.addresses.store'), [
            'name' => 'Mon adresse',
            'country_id' => 1,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => $user->email,
            'is_main' => true,
            'is_billing' => true,
        ])
            ->assertSuccessful()
        ;

        $this->assertEquals('Mon adresse', $user->addresses()->first()->name);
        $this->assertEquals('Mon adresse', $user->address->name);
    }

    /** @test */
    public function first_created_address_is_set_as_main_and_billing()
    {
        $user = $this->signIn();

        $this->followingRedirects()->post(route('user.addresses.store'), [
            'name' => 'Mon adresse',
            'country_id' => 1,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => $user->email,
            'is_main' => false,
            'is_billing' => false,
        ])
            ->assertSuccessful()
        ;

        $this->assertEquals('Mon adresse', $user->addresses()->first()->name);
        $this->assertTrue($user->address->is_main);
        $this->assertTrue($user->address->is_billing);
    }

    /** @test */
    public function if_an_address_is_set_as_main_other_main_address_will_no_longer_be()
    {
        $user = $this->signIn();
        $firstAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);

        $this->assertTrue($firstAddress->is_main);

        $secondAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => false,
        ]);

        $this->assertFalse($firstAddress->fresh()->is_main);
        $this->assertTrue($secondAddress->is_main);
    }

    /** @test */
    public function if_an_address_is_set_as_billing_other_billing_address_will_no_longer_be()
    {
        $user = $this->signIn();
        $firstAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);

        $this->assertTrue($firstAddress->is_billing);

        $secondAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => false,
            'is_billing' => true,
        ]);

        $this->assertFalse($firstAddress->fresh()->is_billing);
        $this->assertTrue($secondAddress->is_billing);
    }
}
