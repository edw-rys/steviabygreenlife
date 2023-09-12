<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->unsignedBigInteger('cart_shop_id');
            $table->unsignedBigInteger('discount_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('cart_shop_id')
                ->references('id')
                ->on('cart_shop')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('discount_id')
                ->references('id')
                ->on('discount_codes')
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
        Schema::dropIfExists('cart_discounts');
    }
}
