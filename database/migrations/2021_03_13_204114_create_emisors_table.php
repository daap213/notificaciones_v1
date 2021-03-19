<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emisors', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('mensaje_id');
			$table->foreign('mensaje_id')
			->references('id')
			->on('mensajes');
			$table->unsignedBigInteger('emisor');
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
        Schema::dropIfExists('emisors');
    }
}
