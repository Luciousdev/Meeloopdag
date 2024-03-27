<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_login()
    {
        $response = $this->call('POST', '/login-user', [
            'email' => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORD'),
        ]);

        $response->assertStatus($response->status(), 302);
    }
}
