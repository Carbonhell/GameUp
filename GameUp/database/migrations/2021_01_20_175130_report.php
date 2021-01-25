<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Report extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reports',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('autore_id');
                $table->unsignedBigInteger('risolutore_id');
                $table->unsignedInteger('contenuto_id');
                $table->text('motivo');
                $table->boolean('giudizio');

                $table->timestamps();
                $table->foreign('autore_id')
                    ->on('users')
                    ->references('id');
                $table->foreign('risolutore_id')
                    ->on('users')
                    ->references('id');
                $table->foreign('contenuto_id')
                    ->on('contenuti')
                    ->references('id');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
