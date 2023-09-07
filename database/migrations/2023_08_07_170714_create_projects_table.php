<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * プロジェクトテーブル
 */
return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1024)->comment('名前');
            $table->unsignedBigInteger('crowd_sourcing_id')->comment('クラウドソーシングID');
            $table->unsignedBigInteger('orderer_id')->comment('発注者ID');
            $table->date('publication_on')->nullable()->comment('掲載日');
            $table->date('application_deadline_on')->nullable()->comment('応募期限');
            $table->integer('contract_amount_excluding_tax')->nullable()->comment('契約金額(税抜)');
            $table->boolean('display')->default(1)->comment('表示 / 非表示');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
