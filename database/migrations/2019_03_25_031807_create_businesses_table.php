<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_business_id')->unsigned();
            $table->foreign('person_business_id')->references('id')->on('person_business')->onDelete('cascade');
            $table->integer('business_type_id')->unsigned();
            $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');
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
        Schema::table('businesses', function(Blueprint $table){
            $table->dropForeign(['business_type_id']);
            $table->dropForeign(['person_business_id']);
        });
        Schema::dropIfExists('businesses');
    }
}
