<?php

namespace Tests\Feature\Shop;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class CartCheckoutTest extends TestCase
{
    /** @test */
    public function cart_page_is_accessible()
    {
        $this->get(route('cart.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.index');
    }

    /** @test */
    public function cart_shipping_address_page_is_not_accessible_if_cart_is_empty()
    {
        $this->get(route('cart.shippings.index'))
            ->assertRedirect(route('shop.categories.index'));
    }

    /** @test */
    public function cart_shipping_address_page_is_accessible()
    {
        $this->addAProductToCart();

        $this->get(route('cart.shippings.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.shipping')
            ->assertSee('Créer un compte');

        $this->signIn();

        $this->get(route('cart.shippings.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.shipping')
            ->assertDontSee('Créer un compte');
    }

    /** @test */
    public function a_user_can_confirm_shippings_informations_without_have_an_account()
    {
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
        ])
            ->assertSuccessful();

        $this->assertEquals(session('billing_address')->street, '30 rue des cocotiers');
    }

    /** @test */
    public function a_user_can_confirm_shippings_and_billing_informations_without_have_an_account()
    {
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
            'billing' => [
                'country_id' => 1,
                'firstname' => 'Jean',
                'lastname' => 'Valjean',
                'street' => '12 rue des cocotiers',
                'additionnal' => '2ème étage',
                'zipcode' => '13100',
                'city' => 'Marseille',
                'phone' => '0615141213',
                'email' => 'email@email.com',
            ],
        ])
            ->assertSuccessful();

        $this->assertEquals(session('billing_address')->street, '12 rue des cocotiers');
        $this->assertEquals(session('shipping_address')->street, '30 rue des cocotiers');
    }

    /** @test */
    public function a_logged_user_can_confirm_shippings_informations_without_have_already_register_an_address()
    {
        $user = $this->signIn();
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
        ])
            ->assertSuccessful();

        $this->assertEquals($user->fresh()->address->street, '30 rue des cocotiers');
        $this->assertEquals($user->fresh()->addresses->firstWhere('is_billing', true)->street, '30 rue des cocotiers');
    }

    /** @test */
    public function a_logged_user_can_confirm_shippings_and_billing_informations_without_have_already_register_an_address()
    {
        $user = $this->signIn();
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
            'billing' => [
                'country_id' => 1,
                'firstname' => 'Jean',
                'lastname' => 'Valjean',
                'street' => '12 rue des cocotiers',
                'additionnal' => '2ème étage',
                'zipcode' => '13100',
                'city' => 'Marseille',
                'phone' => '0615141213',
                'email' => 'email@email.com',
            ],
        ])
            ->assertSuccessful();

        $this->assertEquals($user->fresh()->address->street, '30 rue des cocotiers');
        $this->assertEquals($user->fresh()->addresses->firstWhere('is_billing', true)->street, '12 rue des cocotiers');
    }

    /** @test */
    public function a_logged_user_who_has_already_address_can_confirm_shippings_informations()
    {
        $user = $this->signIn();
        $address = Address::factory()->create(['user_id' => $user->id]);
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            "firstname" => null,
            "lastname" => null,
            "email" => null,
            "phone" => null,
            "street" => null,
            "additionnal" => null,
            "city" => null,
            "zipcode" => null,
            "country_id" => "1"
        ])
            ->assertSuccessful();

        $this->assertEquals($user->address->street, $address->street);
        $this->assertEquals($user->addresses->firstWhere('is_billing', true)->street, $address->street);
    }

    /** @test */
    public function a_logged_user_who_has_already_address_can_create_an_address_and_confirm_shippings_informations_with_this_address()
    {
        $user = $this->signIn();
        Address::factory()->create(['user_id' => $user->id]);
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
        ])
            ->assertSuccessful();

        $this->assertEquals($user->fresh()->address->street, '30 rue des cocotiers');
        $this->assertEquals($user->fresh()->addresses->firstWhere('is_billing', true)->street, '30 rue des cocotiers');
    }

    /** @test */
    public function a_logged_user_who_has_already_address_can_create_a_shipping_address_and_a_billing_address_and_confirm_shippings_informations_with_this_address()
    {
        $user = $this->signIn();
        Address::factory()->create(['user_id' => $user->id]);
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
            'billing' => [
                'country_id' => 1,
                'firstname' => 'Jean',
                'lastname' => 'Valjean',
                'street' => '12 rue des cocotiers',
                'additionnal' => '2ème étage',
                'zipcode' => '13100',
                'city' => 'Marseille',
                'phone' => '0615141213',
                'email' => 'email@email.com',
            ],
        ])
            ->assertSuccessful();

        $this->assertEquals($user->fresh()->address->street, '30 rue des cocotiers');
        $this->assertEquals($user->fresh()->addresses->firstWhere('is_billing', true)->street, '12 rue des cocotiers');
    }

    /** @test */
    public function a_logged_user_who_has_already_address_can_create_a_billing_address_only_and_confirm_shippings_informations_with_this_address()
    {
        $user = $this->signIn();
        $address = Address::factory()->create(['user_id' => $user->id]);
        $this->addAProductToCart();

        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'billing' => [
                'country_id' => 1,
                'firstname' => 'Jean',
                'lastname' => 'Valjean',
                'street' => '12 rue des cocotiers',
                'additionnal' => '2ème étage',
                'zipcode' => '13100',
                'city' => 'Marseille',
                'phone' => '0615141213',
                'email' => 'email@email.com',
            ],
        ])
            ->assertSuccessful();

        $this->assertEquals($user->fresh()->address->street, $address->street);
        $this->assertEquals($user->fresh()->addresses->firstWhere('is_billing', true)->street, '12 rue des cocotiers');
    }

    /** @test */
    public function a_logged_user_who_has_already_address_cannot_create_a_partial_address_and_confirm_shippings_informations_with_this_address()
    {
        $user = $this->signIn();
        $address = Address::factory()->create(['user_id' => $user->id]);
        $this->addAProductToCart();

        $this->post(route('cart.shippings.store'), [
            "firstname" => 'Paul',
            "lastname" => null,
            "email" => null,
            "phone" => null,
            "street" => null,
            "additionnal" => null,
            "city" => null,
            "zipcode" => null,
            "country_id" => "1"
        ])
            ->assertSessionHasErrors('lastname');

        $this->assertEquals($user->fresh()->address->street, $address->street);
    }

    private function addAProductToCart(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();
    }
}
