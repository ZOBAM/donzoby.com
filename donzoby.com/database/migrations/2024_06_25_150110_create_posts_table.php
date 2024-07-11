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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('author_id')->constrained(table: 'users', indexName: 'user_id')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('version')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('type', ['course-series', 'special-series', 'how-tos']);
            $table->string('topic');
            $table->text('content');
            $table->unsignedInteger('hits')->default(0);
            $table->enum('status', ['published', 'unpublished'])->default('unpublished');
            $table->enum('comment_status', ['open', 'closed'])->default('closed');
            $table->unsignedInteger('comment_count')->default(0);
            $table->string('tags');
            $table->string('slug');
            $table->text('description');
            $table->unsignedBigInteger('sort_value')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
