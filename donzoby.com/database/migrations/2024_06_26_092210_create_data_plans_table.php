<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('provider');
            $table->string('title');
            $table->double('volume');
            $table->integer('price');
            $table->integer('bonus_all')->nullable()->default(0);
            $table->integer('bonus_new_sim')->nullable()->default(0);
            $table->integer('validity');
            $table->string('use_period');
            $table->string('how_to_sub');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('hits')->default(0);
            $table->integer('creator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_plans');
    }
};
