<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * プロジェク詳細トテスト
 */
class ProjectDetailTest extends Login
{
    private const ATTRIBUTES =  [
        'name' => '名前',
        'message' => 'メッセージ',
        'upload_file' => 'アップロードファイル',
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
            '/api/project/1/project_detail',
            [
                'name' => '',
                'message' => 'メッセージ',
                'sort_order' => 9,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectDetailTest::ATTRIBUTES['name']]),
            ])
            ->assertInvalid([
                'name' => __('validation.required', ['attribute' => ProjectDetailTest::ATTRIBUTES['name']]),
            ]);
    }

    /**
     * 新規登録する時に「名前」の文字数が1024文字を超えたときのテスト
     */
    public function test_create_name_max(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/project/1/project_detail',
            [
                'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'message' => 'メッセージ',
                'sort_order' => 9,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.string', ['attribute' => ProjectDetailTest::ATTRIBUTES['name'], 'max' => 1024]),
            ])
            ->assertInvalid([
                'name' => __('validation.max.string', ['attribute' => ProjectDetailTest::ATTRIBUTES['name'], 'max' => 1024]),
            ]);
    }

    /**
     * 新規登録する時に「メッセージ」が空文字のときのテスト
     */
    public function test_create_message_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/project/1/project_detail',
            [
                'name' => '名前',
                'message' => '',
                'sort_order' => 9,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectDetailTest::ATTRIBUTES['message']]),
            ])
            ->assertInvalid([
                'message' => __('validation.required', ['attribute' => ProjectDetailTest::ATTRIBUTES['message']]),
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
            '/api/project/1/project_detail',
            [
                'name' => '名前',
                'message' => 'メッセージ',
                'sort_order' => '',
                ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order']]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.required', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order']]),
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
            '/api/project/1/project_detail',
            [
                'name' => '名前',
                'message' => 'メッセージ',
                'sort_order' => 'a',
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.integer', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order']]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.integer', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order']]),
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
            '/api/project/1/project_detail',
            [
                'name' => '名前',
                'message' => 'メッセージ',
                'sort_order' => '-1',
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.min.numeric', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order'], 'min' => 0]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.min.numeric', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order'], 'min' => 0]),
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
            '/api/project/1/project_detail',
            [
                'name' => '名前',
                'message' => 'メッセージ',
                'sort_order' => 256,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.numeric', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order'], 'max' => 255]),
            ])
            ->assertInvalid([
                'sort_order' => __('validation.max.numeric', ['attribute' => ProjectDetailTest::ATTRIBUTES['sort_order'], 'max' => 255]),
            ]);
    }
}