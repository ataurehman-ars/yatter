<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionsTable extends Migration
{
    
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('connection_id');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('connections');
    }
}
