<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginForm()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
