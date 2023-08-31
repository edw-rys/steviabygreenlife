<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeingKeyUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
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
        Schema::dropIfExists('foreing_key_users');
    }
}
