<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('category_products')->insert([
            [
                'product_id' => 1, // 腕時計
                'category_id' => 1, // ファッション
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // HDD
                'category_id' => 2, // 家電
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // 玉ねぎ
                'category_id' => 3, // 食品
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, // 革靴
                'category_id' => 1, // ファッション
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5, // ノートPC
                'category_id' => 2, // 家電
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6, // マイク
                'category_id' => 5, // 趣味・ホビー
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7, // ショルダーバッグ
                'category_id' => 1, // ファッション
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8, // タンブラー
                'category_id' => 4, // 日用品
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9, // コーヒーミル
                'category_id' => 2, // 家電
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 10, // メイクセット
                'category_id' => 4, // 日用品
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
