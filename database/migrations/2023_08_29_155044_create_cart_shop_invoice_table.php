<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartShopInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cart_shop_invoice', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 700);
            $table->unsignedBigInteger('cart_shop_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name', 250);
            $table->string('last_name', 250);

            // Location
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->longText('address');
            $table->string('apartamento', 250)->nullable();
            // End location
            
            
            $table->string('phone', 100)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('instruction', 550)->nullable();
            $table->string('business_name', 550)->nullable();

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

            $table->foreign('country_id')
                ->references('id')
                ->on('country')
                ->onDelete('cascade');

            $table->foreign('state_id')
                ->references('id')
                ->on('state')
                ->onDelete('cascade');
            
            $table->foreign('city_id')
                ->references('id')
                ->on('city')
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
