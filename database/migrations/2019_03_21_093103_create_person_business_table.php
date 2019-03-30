<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->nullable();

            $table->integer('person_business_id')->unsigned()->default(1);
            $table->foreign('person_business_id')->references('id')->on('person_business')->onDelete('cascade');
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
        Schema::table('person_business', function(Blueprint $table){
            $table->dropForeign(['person_business_id']);
        });
        Schema::dropIfExists('person_business');
    }
}
