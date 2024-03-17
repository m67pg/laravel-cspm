<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * プロジェクトテスト
 */
class ProjectTest extends Login
{
    private const ATTRIBUTES =  [
        'name' => '名前',
        'crowd_sourcing_id' => 'クラウドソーシング',
        'orderer_id' => '発注者',
        'progress_id' => '進捗',
        'contract_amount_excluding_tax' => '契約金額(税抜)',
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
            '/api/project',
            [
                'name' => '',
                'crowd_sourcing_id' => 1,
                'orderer_id' => 1,
                'progress_id' => 1,
                'contract_amount_excluding_tax' => 1000,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['name']]),
            ])
            ->assertInvalid([
                'name' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['name']]),
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
            '/api/project',
            [
                'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'crowd_sourcing_id' => 1,
                'orderer_id' => 1,
                'progress_id' => 1,
                'contract_amount_excluding_tax' => 1000,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.max.string', ['attribute' => ProjectTest::ATTRIBUTES['name'], 'max' => 1024]),
            ])
            ->assertInvalid([
                'name' => __('validation.max.string', ['attribute' => ProjectTest::ATTRIBUTES['name'], 'max' => 1024]),
            ]);
    }

    /**
     * 新規登録する時に「クラウドソーシング」が空文字のときのテスト
     */
    public function test_create_crowd_sourcing_id_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/project',
            [
                'name' => '名前',
                'crowd_sourcing_id' => '',
                'orderer_id' => 1,
                'progress_id' => 1,
                'contract_amount_excluding_tax' => 1000,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['crowd_sourcing_id']]),
            ])
            ->assertInvalid([
                'crowd_sourcing_id' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['crowd_sourcing_id']]),
            ]);
    }

    /**
     * 新規登録する時に「発注者」が空文字のときのテスト
     */
    public function test_create_orderer_id_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/project',
            [
                'name' => '名前',
                'crowd_sourcing_id' => 1,
                'orderer_id' => '',
                'progress_id' => 1,
                'contract_amount_excluding_tax' => 1000,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['orderer_id']]),
            ])
            ->assertInvalid([
                'orderer_id' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['orderer_id']]),
            ]);
    }

    /**
     * 新規登録する時に「発注者」が空文字のときのテスト
     */
    public function test_create_progress_id_required(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/project',
            [
                'name' => '名前',
                'crowd_sourcing_id' => 1,
                'orderer_id' => 1,
                'progress_id' => '',
                'contract_amount_excluding_tax' => 1000,
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['progress_id']]),
            ])
            ->assertInvalid([
                'progress_id' => __('validation.required', ['attribute' => ProjectTest::ATTRIBUTES['progress_id']]),
            ]);
    }

    /**
     * 新規登録する時に「発注者」が数値以外のときのテスト
     */
    public function test_create_contract_amount_excluding_tax_numeric(): void
    {
        // ログイン
        $this->login_postJson();
        //$this->login_create();

        $this->response = $this->postJson(
            '/api/project',
            [
                'name' => '名前',
                'crowd_sourcing_id' => 1,
                'orderer_id' => 1,
                'progress_id' => 1,
                'contract_amount_excluding_tax' => 'a',
            ]
        );
        // HTTP422
        $this->response
            ->assertUnprocessable()
            ->assertJson([
                'message' => __('validation.numeric', ['attribute' => ProjectTest::ATTRIBUTES['contract_amount_excluding_tax']]),
            ])
            ->assertInvalid([
                'contract_amount_excluding_tax' => __('validation.numeric', ['attribute' => ProjectTest::ATTRIBUTES['contract_amount_excluding_tax']]),
            ]);
    }
}