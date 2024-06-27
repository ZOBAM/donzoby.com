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
        Schema::create('post_images', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->string('link');
            $table->json('dimension')->nullable(); // this can be used in the future to reserve space for images while it loads
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_images');
    }
};
