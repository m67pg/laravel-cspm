<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * 進捗テスト
 */
class ProgressTest extends Login
{
    private const ATTRIBUTES =  [
        'name' => '名前',
        'sort_order' => '並び順',
    ];

    /**
     * 新規登録する時に「名前」が空文字のときのテスト
     */
    public function test_create_name_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '',
                'sort_order' => 9,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['name']]),
            ])
            ->assertInvalid([
                'name' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['name']]),
            ]);
    }

    /**
     * 新規登録する時に「名前」の文字数が128文字を超えたときのテスト
     */
    public function test_create_name_max(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'sort_order' => 9,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.string', ['attribute' => ProgressTest::ATTRIBUTES['name'], 'max' => 128]),
            ])
            ->assertInvalid([
                'name' => __('validation.max.string', ['attribute' => ProgressTest::ATTRIBUTES['name'], 'max' => 128]),
            ]);
    }

    /**
     * 新規登録する時に「並び順」が空文字のときのテスト
     */
    public function test_create_sort_order_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '進捗',
                'sort_order' => '',
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ]);
    }

    /**
     * 新規登録する時に「並び順」が数値以外のときのテスト
     */
    public function test_create_sort_order_integer(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '進捗',
                'sort_order' => 'a',
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.integer', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.integer', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ]);
    }

    /**
     * 新規登録する時に「並び順」が最小値を下回ったときのテスト
     */
    public function test_create_sort_order_min(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '進捗',
                'sort_order' => -1,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.min.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'min' => 0]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.min.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'min' => 0]),
            ]);
    }

    /**
     * 新規登録する時に「並び順」が最大値を超えたときのテスト
     */
    public function test_create_sort_order_max(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '進捗',
                'sort_order' => 256,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'max' => 255]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.max.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'max' => 255]),
            ]);
    }

    /**
     * 新規登録する時に「名前」が既に登録されているときのテスト
     */
    public function test_create_name_unique(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '進捗１',
                'sort_order' => 9,
                'display' => 1
            ]
        );
        // HTTP200
        $this->response->assertOk();

        $this->response = $this->postJson(
            '/api/progress',
            [
                'name' => '進捗１',
                'sort_order' => 9,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.unique', ['attribute' => ProgressTest::ATTRIBUTES['name']]),
            ])
            ->assertInvalid([
                'name' => __('validation.unique', ['attribute' => ProgressTest::ATTRIBUTES['name']]),
            ]);
    }

    /**
     * 編集する時に「名前」が空文字のときのテスト
     */
    public function test_edit_name_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->putJson(
            '/api/progress/1',
            [
                'name' => '',
                'sort_order' => 9,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['name']]),
            ])
            ->assertInvalid([
                'name' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['name']]),
            ]);
    }

    /**
     * 編集する時に「名前」の文字数が128文字を超えたときのテスト
     */
    public function test_edit_name_max(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->putJson(
            '/api/progress/1',
            [
                'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'sort_order' => 9,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.string', ['attribute' => ProgressTest::ATTRIBUTES['name'], 'max' => 128]),
            ])
            ->assertInvalid([
                'name' => __('validation.max.string', ['attribute' => ProgressTest::ATTRIBUTES['name'], 'max' => 128]),
            ]);
    }

    /**
     * 編集する時に「並び順」が空文字のときのテスト
     */
    public function test_edit_sort_order_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->putJson(
            '/api/progress/1',
            [
                'name' => '進捗',
                'sort_order' => '',
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.required', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ]);
    }

    /**
     * 編集する時に「並び順」が数値以外のときのテスト
     */
    public function test_edit_sort_order_integer(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->putJson(
            '/api/progress/1',
            [
                'name' => '進捗',
                'sort_order' => 'a',
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.integer', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.integer', ['attribute' => ProgressTest::ATTRIBUTES['sort_order']]),
            ]);
    }

    /**
     * 編集する時に「並び順」が最小値を下回ったときのテスト
     */
    public function test_edit_sort_order_min(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->putJson(
            '/api/progress/1',
            [
                'name' => '進捗',
                'sort_order' => -1,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.min.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'min' => 0]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.min.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'min' => 0]),
            ]);
    }

    /**
     * 編集する時に「並び順」が最大値を超えたときのテスト
     */
    public function test_edit_sort_order_max(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->putJson(
            '/api/progress/1',
            [
                'name' => '進捗',
                'sort_order' => 256,
                'display' => 1
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'max' => 255]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.max.numeric', ['attribute' => ProgressTest::ATTRIBUTES['sort_order'], 'max' => 255]),
            ]);
    }
}
