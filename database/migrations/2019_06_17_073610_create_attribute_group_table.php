<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('item_type_id')->unsigned();
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade');
            $table->unique(['name','item_type_id']);
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
        Schema::table('attribute_groups', function(Blueprint $table){
            $table->dropForeign(['item_type_id']);
        });
        Schema::dropIfExists('attribute_groups');
    }
}
