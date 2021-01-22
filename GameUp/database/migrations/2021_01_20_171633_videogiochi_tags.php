<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideogiochiTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tags', function(Blueprint $table) {
            $table->increments('id');
            $table->string('titolo');
        });

        // Pivot users* *tags
        Schema::create('utente_tags', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('utente_id');
            $table->unsignedInteger('tag_id');

            $table->timestamps();
            $table->foreign('utente_id')
                ->on('users')
                ->references('id');
            $table->foreign('tag_id')
                ->on('tags')
                ->references('id');
        });

        // Pivot tags* *videogiochi
        Schema::create('videogiochi_tags', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('videogioco_id');
            $table->unsignedInteger('tag_id');

            $table->timestamps();
            $table->foreign('videogioco_id')
                ->on('videogiochi')
                ->references('id');
            $table->foreign('tag_id')
                ->on('tags')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('videogiochi_tags');
        Schema::dropIfExists('utente_tags');
        Schema::dropIfExists('tags');
    }
}
