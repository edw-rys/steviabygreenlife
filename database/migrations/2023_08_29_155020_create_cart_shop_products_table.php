<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartShopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 700);
            $table->unsignedBigInteger('cart_shop_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();


            $table->string('route_image', 250)->nullable();
            $table->string('name', 250)->nullable();
            $table->longText('description')->nullable();

            $table->integer('count')->nullable();


            $table->string('price_unit', 250)->default(0);
            $table->string('percentage_tax', 250)->default(0);
            $table->string('total_tax', 250)->default(0);
            $table->string('discount_percentage', 250)->default(0);
            $table->string('discount_value', 250)->default(0);
            $table->string('subtotal_after_tax', 250)->default(0);
            $table->string('total', 250)->default(0);

            $table->string('status', 250)->default('created');


            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('cart_shop_id')
                ->references('id')
                ->on('cart_shop')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
