<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * プロジェクト進捗テーブル
 */
return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        Schema::create('project_progresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->comment('プロジェクトID');
            $table->unsignedBigInteger('progress_id')->comment('進捗ID');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     */
    public function down(): void
    {
        Schema::dropIfExists('project_progresses');
    }
};
