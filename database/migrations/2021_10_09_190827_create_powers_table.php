<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('powers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_power_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('game_id')->constrained();
            $table->boolean('is_defeated')->default(false);
            $table->boolean('is_winner')->default(false);
            $table->timestamps();

            $table->unique(['base_power_id', 'game_id']);
            $table->unique(['user_id', 'game_id']);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('powers');
    }
}
