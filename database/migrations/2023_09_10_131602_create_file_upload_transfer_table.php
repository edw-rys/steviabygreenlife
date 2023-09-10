<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_upload_transfer', function (Blueprint $table) {
            $table->id();
            $table->string('size', 200)->nullable();
            $table->text('original_name')->nullable();
            $table->text('filename')->nullable();
            $table->string('extension', 100)->nullable();
            $table->unsignedBigInteger('cart_shop_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('cart_shop_id')
                ->references('id')
                ->on('cart_shop')
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
        Schema::dropIfExists('file_upload_transfer');
    }
}
