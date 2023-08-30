<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_shop', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 700);
            $table->integer('count_products')->default(0);

            $table->string('ip_address', 250)->nullable();

            $table->string('subtotal', 250)->default(0);
            $table->string('discount', 250)->default(0);
            $table->string('subtotal_after_tax', 250)->default(0);
            $table->string('percentage_tax', 250)->default(0);
            $table->string('total_tax', 250)->default(0);
            $table->string('total', 250)->default(0);

            $table->string('status', 250)->default('created');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
