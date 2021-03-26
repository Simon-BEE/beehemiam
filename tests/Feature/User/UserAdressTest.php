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
            ->assertSee(Country::inRandomOrder()->first()->name);
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
            ->assertSuccessful();

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
            ->assertSuccessful();

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

    /** @test */
    public function a_user_can_see_edit_address_form()
    {
        $user = $this->signIn();
        $address = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);

        $this->get(route('user.addresses.edit', $address))
            ->assertSuccessful()
            ->assertViewIs('user.addresses.edit')
            ->assertSee($address->street);
    }

    /** @test */
    public function a_user_cannot_see_edit_address_form_of_an_address_that_does_not_belongs_to_him()
    {
        $this->signIn();
        $address = Address::factory()->create();

        $this->get(route('user.addresses.edit', $address))
            ->assertNotFound();
    }

    /** @test */
    public function a_user_can_edit_an_address()
    {
        $user = $this->signIn();
        $address = Address::factory()->create([
            'name' => 'Mon adresse',
            'user_id' => $user->id,
        ]);

        $this->followingRedirects()->patch(route('user.addresses.update', $address), [
            'name' => 'Mon adresse éditée',
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
            ->assertSuccessful();

        $this->assertEquals('Mon adresse éditée', $address->fresh()->name);
        $this->assertEquals('Mon adresse éditée', $user->address->name);
    }

    /** @test */
    public function a_user_cannot_edit_an_address_that_does_not_belongs_to_him()
    {
        $user = $this->signIn();
        $address = Address::factory()->create([
            'name' => 'Mon adresse',
        ]);

        $this->followingRedirects()->patch(route('user.addresses.update', $address), [
            'name' => 'Mon adresse éditée',
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
            ->assertForbidden();

        $this->assertEquals('Mon adresse', $address->fresh()->name);
    }

    /** @test */
    public function a_user_can_delete_an_address()
    {
        $user = $this->signIn();
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->followingRedirects()->delete(route('user.addresses.destroy', $address))
            ->assertSuccessful();

        $this->assertNull($user->addresses()->first());
    }

    /** @test */
    public function a_user_cannot_delete_an_address_that_does_not_belongs_to_him()
    {
        $this->signIn();
        $address = Address::factory()->create();

        $this->followingRedirects()->delete(route('user.addresses.destroy', $address))
            ->assertForbidden();

        $this->assertNotNull($address);
    }

    /** @test */
    public function if_an_address_is_deleted_and_another_address_exists_so_its_become_main_and_billing_address()
    {
        $user = $this->signIn();
        $firstAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);
        $secondAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => false,
            'is_billing' => false,
        ]);

        $firstAddress->delete();

        $this->assertTrue($secondAddress->fresh()->is_main);
        $this->assertTrue($secondAddress->fresh()->is_billing);
    }

    /** @test */
    public function if_an_address_is_deleted_and_has_is_main_or_is_billing_to_true_then_another_address_get_this_property_to_true()
    {
        $user = $this->signIn();
        $firstAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);
        $secondAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);
        $thirdAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => false,
            'is_billing' => false,
        ]);
        $fourthAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => false,
            'is_billing' => true,
        ]);
        $this->assertFalse($firstAddress->fresh()->is_main);
        $this->assertFalse($firstAddress->fresh()->is_billing);
        $this->assertTrue($secondAddress->fresh()->is_main);
        $this->assertFalse($secondAddress->fresh()->is_billing);

        $secondAddress->fresh()->delete();

        $this->assertTrue($firstAddress->fresh()->is_main);
        $this->assertFalse($thirdAddress->fresh()->is_main);
        $this->assertTrue($fourthAddress->fresh()->is_billing);
        $this->assertNull($secondAddress->fresh());
    }

    /** @test */
    public function a_user_can_see_all_his_addresses()
    {
        $user = $this->signIn();
        Address::factory()->times(5)->create(['user_id' => $user->id]);

        $this->get(route('user.addresses.index'))
            ->assertSuccessful()
            ->assertViewIs('user.addresses.index')
            ->assertSee(Address::inRandomOrder()->first()->street);
    }

    /** @test */
    public function an_address_can_be_set_easily_as_main()
    {
        $user = $this->signIn();
        $firstAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => true,
            'is_billing' => true,
        ]);
        $secondAddress = Address::factory()->create([
            'user_id' => $user->id,
            'is_main' => false,
            'is_billing' => false,
        ]);

        $this->followingRedirects()->patch(route('user.addresses.update.main', $secondAddress))
            ->assertSuccessful();

        $this->assertTrue($secondAddress->fresh()->is_main);
        $this->assertFalse($firstAddress->fresh()->is_main);
    }

}
