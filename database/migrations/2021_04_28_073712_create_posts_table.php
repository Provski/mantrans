<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('user_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('author_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('quote_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->text('post_image')->nullable();
            $table->text('body');
            $table->text('figure')->nullable();
            $table->text('figure_caption')->nullable();
            $table->string('slug')->nullable();
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
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
