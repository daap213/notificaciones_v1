<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')
			->references('id')
			->on('users');
			$table->text('receptor');
			$table->string('tema')->nullable();
			$table->text('mensaje');
			$table->text('archivos')->nullable();
			$table->enum('importancia', ['normal', 'Importante'])->default('normal');
			$table->unsignedBigInteger('RespondidoA')->nullable();
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
        Schema::dropIfExists('mensajes');
    }
}
