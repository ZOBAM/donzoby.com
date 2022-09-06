<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->string('course');//web design, graphics etc
            $table->string('subject');//html, css etc
            $table->text('post_content');
            $table->integer('post_hits');//no of times post was read
            $table->string('post_status')->default("published");//published or not
            $table->string('comment_status')->default("open");//published or not
            $table->integer('comment_count');//now of comments
            $table->string('post_tags');
            $table->string('post_description');//this will be used in page meta data for SEO 
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
        Schema::dropIfExists('posts');
    }
}
