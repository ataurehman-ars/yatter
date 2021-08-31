<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharesTable extends Migration
{
    
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->increments('share_id');
            $table->integer('sharer_id');
            $table->integer('post_id');
            $table->integer('author_id');
            $table->string('sharer_username');
            $table->string('author_username');
            $table->longText('post');
            $table->text('related_photo')->nullable(true);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}



