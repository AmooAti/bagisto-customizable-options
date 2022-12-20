<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amooati_cart_item_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cart_item_id');
            $table->foreign('cart_item_id')->references('id')->on('cart_items')->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('amooati_product_options')->cascadeOnDelete();
            $table->string('option_value');
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
        Schema::dropIfExists('amooati_cart_item_options');
    }
};
