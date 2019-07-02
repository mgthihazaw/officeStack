<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_business_id')->unsigned();
            $table->integer('business_id')->unsigned();

            $table->foreign('person_business_id')->references('id')->on('person_business')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
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
        Schema::table('customers', function(Blueprint $table){
            $table->dropForeign(['person_business_id']);
            $table->dropForeign(['business_id']);
        });
        Schema::dropIfExists('customers');
    }
}
