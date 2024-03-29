<?php

namespace Tests\Feature\Shop\Order;

use App\Mail\Orders\OrderCancelledMail;
use App\Mail\Orders\OrderSummaryMail;
use App\Models\Address;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use App\Models\User;
use App\Notifications\Order\NewOrderNotification;
use App\Notifications\Product\ProductOutOfStockNotification;
use App\Notifications\SimpleAdminNotification;
use App\Repositories\Order\CreateOrderRepository;
use App\Repositories\Order\OrderRepository;
use App\Services\CartAmountService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function a_person_cannot_see_order_page_if_no_products_in_cart_an_no_addresses()
    {
        $this->get(route('cart.orders.index'))
            ->assertRedirect()
            ->assertSessionHas('type', 'Erreur');
    }

    /** @test */
    public function an_unlogged_user_can_see_order_page()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->get(route('cart.orders.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.orders.index');
    }

    /** @test */
    public function a_logged_user_can_see_order_page()
    {
        $this->addAProductToCart();
        $user = $this->signIn();
        Address::factory()->create(['user_id' => $user->id]);

        $this->get(route('cart.orders.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.orders.index');
    }

    /** @test */
    public function when_a_user_pay_an_order_is_created_in_database()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->assertDatabaseCount('orders', 0);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertDatabaseCount('orders', 1);
    }

    /** @test */
    public function when_a_user_pay_order_items_are_created_in_database()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->assertDatabaseCount('order_items', 0);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertDatabaseCount('order_items', 1);
    }

    /** @test */
    public function when_a_user_pay_an_invoice_is_created_in_database()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->assertDatabaseCount('invoices', 0);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertDatabaseCount('invoices', 1);
    }

    /** @test */
    public function when_a_user_pay_a_payment_is_created_in_database()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->assertDatabaseCount('payments', 0);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertDatabaseCount('payments', 1);
    }

    /** @test */
    public function stock_quantity_is_adjusted_when_an_order_is_processed_for_normal_products()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->assertEquals(10, ProductOptionSize::first()->quantity);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertEquals(9, ProductOptionSize::first()->quantity);
    }

    /** @test */
    public function stock_quantity_is_adjusted_when_an_order_is_processed_for_preorder_products()
    {
        $this->addAProductToCart(true);
        $this->setSessionAddress();

        $this->assertEquals(10, PreOrderProductOptionQuantity::first()->quantity);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertEquals(9, PreOrderProductOptionQuantity::first()->quantity);
    }

    /** @test */
    public function when_a_user_pay_a_mail_is_queued_to_client()
    {
        Mail::fake();
        $this->addAProductToCart();
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        Mail::assertQueued(OrderSummaryMail::class);
    }

    /** @test */
    public function when_a_user_pay_a_notification_is_queued_to_administrators()
    {
        Notification::fake();
        $this->addAProductToCart();
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        Notification::assertSentTo(User::administrators()->get(), NewOrderNotification::class);
    }

    /** @test */
    public function when_a_user_pay_cart_sessions_and_addresses_sessions_are_empty()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->assertFalse(cart_is_empty('order'));
        $this->assertTrue(session()->has('billing_address'));

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertTrue(cart_is_empty('order'));
        $this->assertFalse(session()->has('billing_address'));
    }

    /** @test */
    public function when_an_order_is_cancelled_quantity_size_is_adjusted()
    {
        $this->signIn();
        $this->addAProductToCart();
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');
        $order = Order::first();

        $this->assertEquals(9, $order->orderItems->first()->productOption->sizes->first()->quantity);

        $orderRepo = new OrderRepository;
        $orderRepo->cancelTest($order);

        $this->assertEquals(10, $order->orderItems->first()->productOption->fresh()->sizes->first()->quantity);
    }

    /** @test */
    public function when_an_order_is_cancelled_quantity_preorder_is_adjusted()
    {
        $this->signIn();
        $this->addAProductToCart(true);
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');
        $order = Order::first();

        $this->assertEquals(9, $order->orderItems->first()->productOption->preOrderStock->quantity);

        $orderRepo = new OrderRepository;
        $orderRepo->cancelTest($order);

        $this->assertEquals(10, $order->fresh()->orderItems->first()->productOption->preOrderStock->quantity);
    }

    /** @test */
    public function when_an_order_is_cancelled_user_is_notified()
    {
        Mail::fake();
        $this->signIn();
        $this->addAProductToCart(true);
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');
        $order = Order::first();

        $orderRepo = new OrderRepository;
        $orderRepo->cancelTest($order);

        Mail::assertQueued(OrderCancelledMail::class);
    }

    /** @test */
    public function when_an_order_is_cancelled_admins_are_notified()
    {
        Notification::fake();
        $this->signIn();
        $this->addAProductToCart(true);
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');
        $order = Order::first();

        $orderRepo = new OrderRepository;
        $orderRepo->cancelTest($order);

        Notification::assertSentTo(User::administrators()->get(), SimpleAdminNotification::class);
    }

    /** @test */
    public function when_a_user_set_an_order_and_it_was_last_product_available_an_alert_will_send_to_administrators()
    {
        Notification::fake();

        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 1]);
        $this->post(route('api.cart.add.sizes', $productOptionSize));
        $this->setSessionAddress();

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        Notification::assertSentTo(User::administrators()->get(), ProductOutOfStockNotification::class);
    }

    /** @test */
    public function when_a_user_order_with_coupon_a_new_entry_in_database_is_processed()
    {
        $this->signIn();
        $this->addAProductToCart(false, 5000);
        $this->setSessionAddress();
        $this->setSessionCoupon();

        $this->assertDatabaseCount('coupon_order', 0);

        $createOrderRepository = new CreateOrderRepository(new CartAmountService);
        $createOrderRepository->save('client-secret');

        $this->assertDatabaseCount('coupon_order', 1);
    }


    private function addAProductToCart(bool $preorder = false, ?int $price = null): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        if (!is_null($price)) {
            $productOption->update(['price' => $price]);
        }


        if ($preorder) {
            $preOrderOption = $productOption->preOrderStock()->create(['quantity' => 10]);

            $this->post(route('api.cart.add.preorder'), [
                'product_option_id' => $preOrderOption->id,
                'size_id' => 1,
            ]);
        } else {
            $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

            $this->post(route('api.cart.add.sizes', $productOptionSize));
        }
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

    private function setSessionCoupon(): void
    {
        $coupon = Coupon::factory()->create(['amount' => 10]);
        $this->followingRedirects()->post(route('api.cart.coupons.add', ['coupon' => $coupon->code]))
            ->assertSuccessful();
    }

}
