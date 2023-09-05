<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCartStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_shop_store', function (Blueprint $table) {
            $table->longText('request')->nullable()->after('status');
            $table->longText('response')->nullable()->after('status');
            $table->string('response_id', 300)->nullable()->after('status');
            $table->string('card_type', 100)->nullable()->after('status');
            $table->string('last_digits', 50)->nullable()->after('status');
            $table->string('card_brand', 500)->nullable()->after('status');
            $table->string('amount', 250)->nullable()->after('status');
            $table->string('status_pay', 100)->nullable()->after('status');
            $table->string('status_pay_code', 25)->nullable()->after('status');
            $table->string('document', 100)->nullable()->after('status');
            $table->string('authorization_code', 100)->nullable()->after('status');
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
