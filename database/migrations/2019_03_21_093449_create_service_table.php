<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('received_id');
            $table->integer('staff_id')->unsigned();
            $table->integer('service_engineer_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('township')->nullable();
            $table->text('description');
            $table->text('remark');
            $table->text('service_description')->nullable();
            $table->text('service_remark')->nullable();

            $table->boolean('pending')->default(false);
            
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('service_engineer_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::table('services', function(Blueprint $table){
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['service_engineer_id']);
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('services');
    }
}
