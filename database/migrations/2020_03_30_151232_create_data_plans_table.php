<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->string('title');
            $table->integer('volume')->unsigned(); //in mb, 
            $table->integer('price')->unsigned();//in Naira, 
            $table->integer('bonus_all')->unsigned()->nullable(); //in mb, 
            $table->integer('bonus_new_sim')->unsigned()->nullable(); //in mb, 
            $table->integer('validity')->unsigned();//in hrs, 
            $table->string('use_period');
            $table->integer('creator'); //in mb, 
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
        Schema::dropIfExists('data_plans');
    }
}
