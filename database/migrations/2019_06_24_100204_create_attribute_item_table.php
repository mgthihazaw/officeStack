<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_item', function (Blueprint $table) {
            $table->integer('item_id')->unsigned();
            $table->integer('attribute_id')->unsigned();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_item', function(Blueprint $table){
            $table->dropForeign(['item_id']);
            $table->dropForeign(['attribute_id']);
        });
        Schema::dropIfExists('attribute_item');
    }
}
