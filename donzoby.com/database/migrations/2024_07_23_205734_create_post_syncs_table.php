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
        Schema::create('post_syncs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->text('what_changed');
            $table->boolean('synced')->default(false);
            $table->unsignedInteger('sync_attempts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_syncs');
    }
};
