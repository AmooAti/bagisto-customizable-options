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
            $table->string('type')->nullable();
            $table->boolean('is_required')->default(1);
            $table->string('sku')->nullable();
            $table->unsignedInteger('max_characters')->nullable();
            $table->string('file_extension')->nullable();
            $table->unsignedSmallInteger('image_size_x')->nullable();
            $table->unsignedSmallInteger('image_size_y')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreign('product_id')->on('products')->references('id')->cascadeOnDelete();
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
