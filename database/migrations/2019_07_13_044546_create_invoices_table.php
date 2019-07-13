<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->integer('total_price');
            $table->foreign('service_id')->references('id')->on('services');
            $table->integer('invoiceable_id')->unsigned();
            $table->string('invoiceable_type');
            $table->date('opened_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function(Blueprint $table){
            $table->dropForeign(['service_id']);
        });
        Schema::dropIfExists('invoices');
    }
}
