<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_modes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('room_creation_allowed');
            $table->boolean('signing_allowed');
            $table->boolean('adjustment_messages_allowed');
            $table->boolean('move_messages_allowed');
            $table->boolean('retreat_messages_allowed');
            $table->boolean('non_playing_messages_allowed');
            $table->boolean('pre_game_messages_allowed');
            $table->boolean('post_game_messages_allowed');
            $table->boolean('show_player_identities_during_game');
            $table->boolean('is_custom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_modes');
    }
};
