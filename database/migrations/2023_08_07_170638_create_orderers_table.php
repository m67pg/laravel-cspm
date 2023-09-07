<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 発注者テーブル
 */
return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        Schema::create('orderers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->comment('名前');
            $table->tinyInteger('sort_order')->unsigned()->comment('並び順');
            $table->boolean('display')->default(1)->comment('表示 / 非表示');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     */
    public function down(): void
    {
        Schema::dropIfExists('orderers');
    }
};
