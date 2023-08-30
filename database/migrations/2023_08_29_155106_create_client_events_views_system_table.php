<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientEventsViewsSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_events_views_system', function (Blueprint $table) {
            $table->id();
            $table->string('action', '50');
            $table->string('context', '250');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address', 250)->default(null);
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->time('time_action')->nullable();

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->text('authorization')->nullable();

            $table->string('browser',250)->nullable();
            $table->smallInteger('no_accesible')->default(0);
            $table->string('operative_system',250)->nullable();
            $table->string('user_agent',250)->nullable();
            $table->string('canal',250)->nullable();
            // location
            $table->text('city')->nullable();
            $table->text('region_code')->nullable();
            $table->text('region')->nullable();
            $table->text('region_name')->nullable();
            $table->text('country_code')->nullable();
            $table->text('country_name')->nullable();
            $table->text('continent_code')->nullable();
            $table->text('continent_name')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('timezone')->nullable();
            $table->text('location_accuracy_radius')->nullable();

            

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_events_views_system');
    }
}
