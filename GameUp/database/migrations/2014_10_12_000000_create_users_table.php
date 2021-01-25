<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('username')->unique();
                $table->string('password');
                $table->string('email')->unique();
                $table->string('avatar')->nullable();
                $table->unsignedSmallInteger('ruolo')->default(\App\Data\Utenza::ROLE_CLIENT);
                $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
