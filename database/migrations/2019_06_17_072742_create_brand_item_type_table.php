<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandItemTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('brand_item_type', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned();
            $table->integer('item_type_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade');
            $table->unique(['brand_id', 'item_type_id']);
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
        Schema::table('brand_item_type', function(Blueprint $table){
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['item_type_id']);

        });
        Schema::dropIfExists('brand_item_type');
    }
}
