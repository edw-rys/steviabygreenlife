<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartShopProductsStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_shop_products_store', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_shop_id');
            $table->unsignedBigInteger('cart_shop_store_id');
            $table->unsignedBigInteger('shop_cart_id');
            $table->integer('count')->default(0);
            $table->string('transaction', 100);
            $table->string('status', 100)->default('created');

            $table->foreign('shop_cart_id')
                ->references('id')
                ->on('cart_shop')
                ->onDelete('cascade');

            $table->foreign('cart_shop_store_id')
                ->references('id')
                ->on('cart_shop_store')
                ->onDelete('cascade');

            $table->foreign('product_shop_id')
                ->references('id')
                ->on('cart_shop_products')
                ->onDelete('cascade');
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
        Schema::dropIfExists('cart_shop_products_store');
    }
}
