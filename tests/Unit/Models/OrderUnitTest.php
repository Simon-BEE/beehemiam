<?php

namespace Tests\Unit\Models;

use App\Models\Order;
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
    public function an_order_has_a_property_path()
    {
        $order = Order::factory()->create();

        $this->assertNotNull($order->path);
        $this->assertEquals('/order', $order->path);
    }
}
