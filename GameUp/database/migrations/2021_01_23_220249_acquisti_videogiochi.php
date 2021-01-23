<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcquistiVideogiochi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisti_videogiochi', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('videogioco_id');
            $table->unsignedBigInteger('compratore_id');

            $table->timestamps();
            $table->foreign('videogioco_id')
                ->on('videogiochi')
                ->references('id');
            $table->foreign('compratore_id')
                ->on('users')
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
        Schema::dropIfExists('acquisti_videogiochi');
    }
}
