<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('post_id')->index()->nullable()->constrained('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('parent_id')->unsigned()->index();
            $table->integer('is_active')->default(0);
            $table->text('comment');
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
        Schema::dropIfExists('comments');
        // $table->dropForeign('comments_post_id_foreign');

    }
}
