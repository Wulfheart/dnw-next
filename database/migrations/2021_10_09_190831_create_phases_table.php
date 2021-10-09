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
            $table->enum('type', ["MOVE","ADJUSTMENT","RETREAT","NON_PLAYING"]);
            $table->foreignId('previous_phase_id')->nullable()->constrained('phases');
            $table->longText('svg_adjudicated');
            $table->longText('svg_with_orders');
            $table->longText('state_encoded');
            $table->string('phase_name_long');
            $table->string('phase_name_short');
            $table->dateTime('adjudication_at')->nullable();
            $table->string('adjudicated_at')->nullable();
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
        Schema::dropIfExists('phases');
    }
}
