<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

/**
 * ログイン
 */
class Login extends TestCase
{
    protected $response;

    /**
     * ログイン（既存のユーザーにログイン）
     */
    protected function login_postJson(): void
    {
        $this->response = $this->postJson(
            '/api/login',
            [
                'email' => 'owaki1009@gmail.com',
                'password' => 's24K03;15',
                'remember' => false
            ]
        );
    }

    /**
     * ログイン（新規にユーザーを作成してログイン）
     */
    protected function login_create(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
