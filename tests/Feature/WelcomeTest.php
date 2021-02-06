<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /** @test */
    public function view_welcome_is_show_on_first_page()
    {
        $this->get('/')->assertSuccessful()->assertViewIs('welcome');
    }
    
}
