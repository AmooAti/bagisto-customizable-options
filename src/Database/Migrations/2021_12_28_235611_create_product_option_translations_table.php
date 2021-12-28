<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('amooati_product_option_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('locale');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('amooati_product_option_translations');
    }
}