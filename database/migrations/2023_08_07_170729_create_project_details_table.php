<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * プロジェクト詳細テーブル
 */
return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1024)->comment('名前');
            $table->unsignedBigInteger('project_id')->comment('プロジェクトID');
            $table->text('message')->comment('メッセージ');
            $table->string('upload_file', 1024)->nullable()->comment('アップロードファイル');
            $table->tinyInteger('sort_order')->unsigned()->default(9)->comment('並び順');
            $table->boolean('display')->default(1)->comment('表示 / 非表示');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
