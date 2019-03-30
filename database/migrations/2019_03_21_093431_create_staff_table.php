<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_business_id')->unsigned();
            $table->integer('role_id')->unsigned();
            

            $table->foreign('person_business_id')->references('id')->on('person_business')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staffs', function(Blueprint $table){
            $table->dropForeign(['person_business_id']);
            $table->dropForeign(['role_id']);
            

        });
        Schema::dropIfExists('staffs');
    }
}
