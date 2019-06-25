<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('brand_id')->unsigned();
            $table->integer('item_type_id')->unsigned();
            $table->string('model_no')->nullable()->unique();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade');
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
        Schema::table('items', function(Blueprint $table){
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['item_type_id']);
        });
        Schema::dropIfExists('items');
    }
}
