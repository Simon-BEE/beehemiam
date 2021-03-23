<?php

namespace Tests\Feature\Pages;

use Tests\TestCase;

class PagesTest extends TestCase
{
    /** @test */
    public function a_visitor_can_see_terms_conditions_page()
    {
        $this->get(route('pages.terms-conditions'))
            ->assertSuccessful()
            ->assertViewIs('pages.terms-conditions');
    }

    /** @test */
    public function a_visitor_can_see_privacy_policy_page()
    {
        $this->get(route('pages.privacy-policy'))
            ->assertSuccessful()
            ->assertViewIs('pages.privacy-policy');
    }

    /** @test */
    public function a_visitor_can_see_sales_conditions_page()
    {
        $this->get(route('pages.sales-conditions'))
            ->assertSuccessful()
            ->assertViewIs('pages.sales-conditions');
    }

    /** @test */
    public function a_visitor_can_see_delivery_returns_page()
    {
        $this->get(route('pages.delivery-returns'))
            ->assertSuccessful()
            ->assertViewIs('pages.delivery-returns');
    }
}
