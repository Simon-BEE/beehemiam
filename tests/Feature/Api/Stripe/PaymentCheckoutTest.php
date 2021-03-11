<?php

namespace Tests\Feature\Api\Stripe;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class PaymentCheckoutTest extends TestCase
{
    /** @test */
    public function a_user_generate_a_payment_intent_token()
    {
        $this->withoutExceptionHandling();
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->get(route('api.payments.stripe.payment-intent'))
            ->assertSuccessful()
            ->assertJsonStructure(['client_secret', 'total_amount']);
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
