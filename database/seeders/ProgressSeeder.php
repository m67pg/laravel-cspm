<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 進捗シーダ
 */
class ProgressSeeder extends Seeder
{
    /**
     * データベースに対するデータ設定の実行
     */
    public function run(): void
    {
        DB::table('progresses')->insert([
            'name' => '10_応募検討中',
            'sort_order' => 10,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '11_応募済み',
            'sort_order' => 11,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '12_募集終了-未応募',
            'sort_order' => 12,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '13_募集終了-応募済み',
            'sort_order' => 13,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '20_応募・スカウト',
            'sort_order' => 20,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '21_条件交渉',
            'sort_order' => 21,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '30_条件合意=>契約=>仮払い',
            'sort_order' => 30,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '31_業務',
            'sort_order' => 31,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '32_業務中フィードバック',
            'sort_order' => 32,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '33_納品=>検収',
            'sort_order' => 33,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '34_検収中フィードバック',
            'sort_order' => 34,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '35_支払い=>完了',
            'sort_order' => 35,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '36_評価',
            'sort_order' => 36,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '40_完了後フィードバック',
            'sort_order' => 40,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '41_完了',
            'sort_order' => 41,
            'display' => 1,
        ]);
        DB::table('progresses')->insert([
            'name' => '50_契約途中終了リクエスト',
            'sort_order' => 50,
            'display' => 1,
        ]);
    }
}
