<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCartShopStatusesDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_shop', function (Blueprint $table) {
            $table->string('status_delivery')->nullable()->after('status')->default('pending');
            $table->string('status_delivery_lang')->nullable()->after('status_delivery')->default('Pendiente');
            $table->string('status_delivery_color')->nullable()->after('status_delivery_lang')->default('#EEE200');
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
