<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');       // 出品者のユーザーID
        $table->unsignedBigInteger('condition_id');  // 商品の状態ID
        $table->string('name');                      // 商品名
        $table->integer('price');                    // 価格
        $table->string('brand_name')->nullable();         // ブランド（任意）
        $table->text('description');                 // 説明文
        $table->string('img_url');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
