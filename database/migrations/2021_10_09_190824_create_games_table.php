<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('variant_id')->constrained();
            $table->unsignedInteger('phase_length');
            $table->boolean('is_paused')->default(false);
            $table->unsignedInteger('scs_to_win')->nullable();
            $table->unsignedInteger('join_phase_length')->nullable();
            $table->boolean('start_when_ready')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('games');
    }
}
