<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeItemtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_item_type', function (Blueprint $table) {
            $table->integer('item_type_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->unique(['item_type_id', 'attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_item_type', function(Blueprint $table){
            $table->dropForeign(['item_type_id']);
            $table->dropForeign(['attribute_id']);

        });
        Schema::dropIfExists('attribute_item_type');
    }
}
