<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCartStore3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_shop_store', function (Blueprint $table) {
            $table->text('message')->nullable()->after('status_pay_code');
            $table->string('currency', 100)->nullable()->after('status_pay_code');
            $table->string('message_code', 100)->nullable()->after('status_pay_code');
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
