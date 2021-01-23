<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideogiochiRecensioni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videogiochi_recensioni', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('autore_id');
            $table->unsignedInteger('videogioco_id');
            $table->boolean('giudizio');
            $table->text('commento');

            $table->timestamps();
            $table->foreign('autore_id')
                ->on('users')
                ->references('id');
            $table->foreign('videogioco_id')
                ->on('videogiochi')
                ->references('id');
        });

        Schema::create('recensioni_valutazioni', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('autore_id');
            $table->unsignedInteger('recensione_id');
            $table->boolean('giudizio');

            $table->timestamps();
            $table->foreign('autore_id')
                ->on('users')
                ->references('id');
            $table->foreign('recensione_id')
                ->on('videogiochi_recensioni')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recensioni_valutazioni');
        Schema::dropIfExists('videogiochi_recensioni');
    }
}
