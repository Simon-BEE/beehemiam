<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\SaltEncryptorService;
use Tests\TestCase;

class OrderUnitTest extends TestCase
{
    /** @test */
    public function an_order_has_a_property_formatted_price()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->formatted_price);
        $this->assertEquals($order->price / 100, $order->formatted_price);
    }

    /** @test */
    public function an_order_has_a_property_formatted_shipping_fees()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->formatted_shipping_fees);
        $this->assertEquals($order->shipping_fees / 100, $order->formatted_shipping_fees);
    }

    /** @test */
    public function an_order_has_a_property_price_without_taxes()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->price_without_taxes);
        $this->assertEquals($order->price - ($order->price * ($order->tax / 100)), $order->price_without_taxes);
    }

    /** @test */
    public function an_order_has_a_property_formatted_price_without_taxes()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->formatted_price_without_taxes);
        $this->assertEquals(number_format($order->price_without_taxes / 100, 2), $order->formatted_price_without_taxes);
    }

    /** @test */
    public function an_order_has_a_property_formatted_total_taxes()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->formatted_total_taxes);
        $this->assertEquals(number_format($order->formatted_price * ($order->tax / 100), 2), $order->formatted_total_taxes);
    }

    /** @test */
    public function an_order_has_a_property_path_who_returns_route_guest_order_with_encrypted_id_for_a_guest_order()
    {
        $order = Order::factory()->create([
            'user_id' => null,
        ]);

        $this->assertNotNull($order->path);
        $this->assertNotNull($order->hashed_id);
        $this->assertEquals(route('guest.orders.show', $order->hashed_id), url('/') . '/commandes/' . $order->hashed_id);
    }

    /** @test */
    public function an_order_has_a_property_path_who_returns_order_user_route_for_a_user_order()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->path);
        $this->assertEquals(route('user.orders.show', $order), $order->path);
    }

    /** @test */
    public function an_order_has_a_property_verbose_status()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->verbose_status);
        $this->assertEquals("Votre commande est en cours de traitement.", $order->verbose_status);
    }

    /** @test */
    public function an_order_has_a_property_is_in_progress()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->is_in_progress);
        $this->assertTrue($order->is_in_progress);

        $preorder = Order::factory()->create(['has_preorder' => true]);

        $this->assertTrue($preorder->has_preorder && $order->is_in_progress);
    }

    /** @test */
    public function an_order_has_a_property_is_cancelled()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->is_cancelled);
        $this->assertFalse($order->is_cancelled);

        $order->update(['order_status_id' => OrderStatus::CANCELLED]);

        $this->assertTrue($order->refresh()->is_cancelled);
    }

    /** @test */
    public function an_order_has_a_property_is_completed()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->is_completed);
        $this->assertFalse($order->is_completed);

        $order->update(['order_status_id' => OrderStatus::COMPLETED]);

        $this->assertTrue($order->refresh()->is_completed);
    }

    /** @test */
    public function an_order_has_a_property_is_shipped()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->is_shipped);
        $this->assertFalse($order->is_shipped);

        $order->update(['order_status_id' => OrderStatus::SHIPPING]);

        $this->assertTrue($order->refresh()->is_shipped);
    }

    /** @test */
    public function an_order_has_a_property_email_contact()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->email_contact);
    }
}
