<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->integer('author_id');
            $table->integer('post_id');
            $table->text('comment');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}




