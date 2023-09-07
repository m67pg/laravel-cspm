<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * クラウドソーシングシーダ
 */
class CrowdSourcingSeeder extends Seeder
{
    /**
     * データベースに対するデータ設定の実行
     */
    public function run(): void
    {
        DB::table('crowd_sourcings')->insert([
            'name' => 'クラウドワークス',
            'sort_order' => 1,
            'display' => 1,
        ]);
        DB::table('crowd_sourcings')->insert([
            'name' => 'ランサーズ',
            'sort_order' => 2,
            'display' => 1,
        ]);
        DB::table('crowd_sourcings')->insert([
            'name' => 'ココナラ',
            'sort_order' => 3,
            'display' => 1,
        ]);
    }
}
