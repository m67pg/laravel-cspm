<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * ログインテスト
 */
class LoginTest extends Login
{
    /**
     * ログインテスト
     */
    public function test_login_assertOk(): void
    {
        $this->login_postJson();
        // HTTP200
        $this->response->assertOk();
    }

    /**
     * ログアウトテスト
     */
    public function test_logout_assertOk(): void
    {
        $this->login_postJson();
        // HTTP200
        $this->response->assertOk();

        $this->response = $this->postJson('/api/logout');
        $this->response->assertOk();
    }
}
