<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmooatiProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amooati_product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->enum('type', ['text']);
            $table->unsignedTinyInteger('required')->default(0);
            $table->unsignedSmallInteger('max_characters')->nullable();
            $table->string('file_extension')->nullable();
            $table->unsignedInteger('max_file_size')->nullable();
            $table->unsignedInteger('max_image_size_x')->nullable();
            $table->unsignedInteger('max_image_size_y')->nullable();
            $table->unsignedSmallInteger('position')->default(0);
            $table->decimal('price', 12, 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amooati_product_options');
    }
}
