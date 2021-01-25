<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Videogiochi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'contenuti',
            function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('visibile');
            }
        );
        Schema::create(
            'videogiochi',
            function (Blueprint $table) {
                $table->unsignedInteger('id')->primary();
                $table->unsignedBigInteger('autore_id');
                $table->string('logo');
                $table->string('titolo');
                $table->text('descrizione');
                $table->decimal('prezzo');
                $table->date('data_pubblicazione');

                $table->timestamps();
                $table->foreign('id')
                    ->on('contenuti')
                    ->references('id');
                $table->foreign('autore_id')
                    ->on('users')
                    ->references('id');
            }
        );

        Schema::create(
            'videogiochi_immagini',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('videogioco_id');
                $table->string('immagine');

                $table->timestamps();
                $table->foreign('videogioco_id')
                    ->on('videogiochi')
                    ->references('id');
            }
        );

        Schema::create(
            'videogiochi_versioni',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('videogioco_id');
                $table->string('versione');
                $table->string('eseguibile');
                $table->text('changelog');

                $table->timestamps();
                $table->foreign('videogioco_id')
                    ->on('videogiochi')
                    ->references('id');
            }
        );

        Schema::create(
            'videogiochi_sponsorizzazioni',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('videogioco_id');
                $table->date('data_inizio');
                $table->date('data_fine');
                $table->decimal('costo');

                $table->timestamps();
                $table->foreign('videogioco_id')
                    ->on('videogiochi')
                    ->references('id');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('videogiochi_sponsorizzazioni');
        Schema::dropIfExists('videogiochi_versioni');
        Schema::dropIfExists('videogiochi_immagini');
        Schema::dropIfExists('videogiochi');
        Schema::dropIfExists('contenuti');
    }
}
