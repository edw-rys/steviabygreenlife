<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->longText('description')->nullable();
            $table->string('route_image', 500)->default(null)->nullable();
            $table->integer('order_index')->default('0');
            $table->unsignedBigInteger('category_id');

            $table->string('price', 250);
            $table->string('percentage_tax', 250);
            $table->string('total_tax', 250);
            $table->string('price_unit', 250);
            $table->string('discount_percentage', 250);
            $table->string('discount_value', 250);
            
            $table->string('field_1', 250);
            $table->string('field_2', 250);
            $table->string('field_3', 250);

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('category_product')
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
