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
        DB::beginTransaction();

        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_business_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('secret')->default(bcrypt('microstack'));

            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('person_business_id')->references('id')->on('person_business')->onDelete('cascade');

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
        Schema::table('staffs', function(Blueprint $table){
            $table->dropForeign(['business_id']);
            $table->dropForeign(['person_business_id']);
        });
        Schema::dropIfExists('staffs');
    }
}
