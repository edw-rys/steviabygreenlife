<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCartProducts5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_shop_products', function (Blueprint $table) {
            $table->string('subtotal_before_discount', 250)->default(0);
        });
        Schema::table('cart_shop', function (Blueprint $table) {
            $table->string('subtotal_before_discount', 250)->default(0);
            $table->string('total_before_tax', 250)->default(0);
            
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
