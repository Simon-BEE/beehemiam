<?php

namespace Tests\Feature\Api\Stripe;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class PaymentCheckoutTest extends TestCase
{
    /** @test */
    public function a_user_generate_a_payment_intent_token()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->get(route('api.payments.stripe.payment-intent'))
            ->assertSuccessful()
            ->assertJsonStructure(['client_secret', 'total_amount']);
    }

    /** @test */
    public function a_user_can_pay_and_so_register_his_order()
    {
        $this->withoutExceptionHandling();
        $this->addAProductToCart();
        $this->setSessionAddress();
        $address = get_client_shipping_address();

        $this->post(route('api.orders.store'), ['client_secret' => 'secret_key'])
            ->assertSuccessful()
            ->assertJsonStructure(['success', 'order_link']);

        $order = Order::first();

        $this->assertNotNull($order);
        $this->assertTrue($order->orderItems->isNotEmpty());
        $this->assertTrue(carts_are_empty());
        $this->assertNull(get_client_shipping_address());
        $this->assertEquals($address->email, $order->address->email);
        $this->assertEquals($address->email, $order->invoice->address->email);
        $this->assertEquals('En préparation', $order->status->name);
        $this->assertDatabaseCount('payments', 1);
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

    private function setSessionAddress(): void
    {
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
    }
}
