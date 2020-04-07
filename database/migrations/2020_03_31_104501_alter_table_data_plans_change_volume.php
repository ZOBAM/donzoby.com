<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDataPlansChangeVolume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_plans', function (Blueprint $table) {
            $table->float('volume')->change();
            $table->string('how_to_sub')->after("use_period");
            $table->string('description')->after("how_to_sub");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_plans', function (Blueprint $table) {
            $table->integer('volume')->change();
            $table->dropColumn('how_to_sub');
            $table->dropColumn('description');
        });
    }
}
