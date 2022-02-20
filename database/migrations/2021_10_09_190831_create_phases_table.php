<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedInteger('number');
            $table->foreignId('game_id')->constrained('games');
            $table->string('svg_adjudicated');
            $table->string('svg_with_orders')->nullable();
            $table->longText('state_encoded');
            $table->string('phase_name_long');
            $table->string('phase_name_short');
            $table->dateTime('adjudication_at')->nullable();
            $table->string('adjudicated_at')->nullable();
            $table->timestamps();

            $table->unique('svg_adjudicated');
            $table->unique('svg_with_orders');
            $table->unique(['id', 'number']);
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
        Schema::dropIfExists('phases');
    }
}
