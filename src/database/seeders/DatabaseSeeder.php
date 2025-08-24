<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ConditionSeeder::class,  // ① 先にコンディションを挿入
            ProductsTableSeeder::class,  // ② 次に商品を挿入
            CategoriesTableSeeder::class,
            CategoryProductSeeder::class,

            ]);
    }
}
