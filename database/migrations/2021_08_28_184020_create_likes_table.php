<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('liker_id');
            $table->string('liker_username');
            $table->text('liker_photo_path');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}



