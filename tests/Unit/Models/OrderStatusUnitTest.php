<?php

namespace Tests\Unit\Models;

use App\Models\OrderStatus;
use Tests\TestCase;

class OrderStatusUnitTest extends TestCase
{
    /** @test */
    public function a_scope_order_change_status_exists()
    {
        $this->assertNotNull(OrderStatus::orderChange());
        $this->assertCount(6, OrderStatus::orderChange()->get());
    }

}
