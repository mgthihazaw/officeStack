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
        DB::beginTransaction();

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_one');
            $table->integer('price_two')->nullable();
            $table->integer('price_three')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('item_type_id')->unsigned();
            $table->string('model_no')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade');
            $table->timestamps();
        });

        DB::commit();
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
