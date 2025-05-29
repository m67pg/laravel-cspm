<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 実行したいSeederクラスをここに記述します
        $this->call([
            CrowdSourcingSeeder::class,
            ProgressSeeder::class,
            //UserSeeder::class, // 例: UserSeederを呼び出す
            // もし他のSeederもあれば追加します
            // ProductSeeder::class,
        ]);

        // 元々コメントアウトされていたfactoryの呼び出しを使う場合
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}