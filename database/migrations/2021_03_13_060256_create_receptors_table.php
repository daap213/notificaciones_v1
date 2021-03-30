<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mensaje_id');
            $table->foreign('mensaje_id')
                ->references('id')
                ->on('mensajes')
                ->onDelete('cascade');
            $table->unsignedBigInteger('receptor');
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
        Schema::dropIfExists('receptors');
    }
}
