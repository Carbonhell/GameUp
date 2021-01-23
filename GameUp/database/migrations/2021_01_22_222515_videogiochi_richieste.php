<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideogiochiRichieste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videogiochi_richieste', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('autore_id');
            $table->string('logo');
            $table->string('titolo');
            $table->text('descrizione');
            $table->decimal('prezzo');
            $table->unsignedSmallInteger('tipo');
            $table->string('eseguibile');
            $table->boolean('esito')->nullable();
            $table->text('commento')->nullable();

            $table->timestamps();
            $table->foreign('autore_id')
                ->on('users')
                ->references('id');
        });

        Schema::create('videogiochi_richieste_immagini', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('richiesta_id');
            $table->string('immagine');

            $table->foreign('richiesta_id')
                ->on('videogiochi_richieste')
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
        Schema::dropIfExists('videogiochi_richieste_immagini');
        Schema::dropIfExists('videogiochi_richieste');
    }
}
