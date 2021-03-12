<?php

namespace Tests\Unit\Models;

use App\Models\OrderItem;
use Tests\TestCase;

class OrderItemUnitTest extends TestCase
{
    /** @test */
    public function an_order_item_has_a_property_formatted_price()
    {
        $orderItem = OrderItem::factory()->create();

        $this->assertNotNull($orderItem->formatted_price);
        $this->assertEquals($orderItem->price / 100, $orderItem->formatted_price);
    }
}
