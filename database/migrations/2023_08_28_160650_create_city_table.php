<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->id();
            $table->string('name', 550);
            
            $table->unsignedBigInteger('state_id')->nullable();;
            $table->unsignedBigInteger('country_id')->nullable();;
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable()->default(null);

            $table->foreign('state_id')
                ->references('id')
                ->on('state')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('id')
                ->on('country')
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
        Schema::dropIfExists('city');
    }
}
