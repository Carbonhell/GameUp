<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Discussioni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'discussioni',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('videogioco_id');
                $table->string('titolo');
                $table->boolean('in_rilievo')->default(false);
                $table->boolean('chiusa')->default(false);

                $table->timestamps();
                $table->foreign('videogioco_id')
                    ->on('videogiochi')
                    ->references('id');
            }
        );

        Schema::create(
            'commenti',
            function (Blueprint $table) {
                $table->unsignedInteger('id')->primary();
                $table->unsignedInteger('discussione_id');
                $table->text('corpo');

                $table->timestamps();
                $table->foreign('id')
                    ->on('contenuti')
                    ->references('id');
                $table->foreign('discussione_id')
                    ->on('discussioni')
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
        Schema::dropIfExists('commenti');
        Schema::dropIfExists('discussioni');
    }
}
