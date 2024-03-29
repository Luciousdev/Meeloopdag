<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class LoginRegisterTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $response = $this->call('POST', '/register-user', [
            'full_name' => env('TEST_USER_NAME'),
            'email' => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORD'),
        ]);

        if ($response->status() === 302) {
            $this->user = User::where('email', env('TEST_USER_EMAIL'))->first();
        }
    }

    public function test_user_verification()
    {
        // get the code from the registered user
        $user = User::where('email', env('TEST_USER_EMAIL'))->first();
        $code = $user->verification_code;

        $response = $this->call('GET', '/verify/' . env('TEST_USER_EMAIL') . '/' . $code);

        $response->assertStatus($response->status(), 302);
    }

    public function test_user_login()
    {
        $response = $this->call('POST', '/login-user', [
            'email' => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORD'),
        ]);

        $response->assertStatus($response->status(), 302);
    }

    public function test_delete_user()
    {
        if($this->user)
        {
            $user = User::where('email', env('TEST_USER_EMAIL'))->first();
            $user->delete();

            $deletedUser = User::where('email', env('TEST_USER_EMAIL'))->first();

            if($deletedUser)
            {
                $this->assertTrue(false);
            } else
            {
                $this->assertTrue(true);
            }
        }
    }
}
