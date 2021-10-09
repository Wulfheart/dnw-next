<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageRoomMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('message_room_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('power_id')->constrained();
            $table->foreignId('message_room_id')->constrained();
            $table->dateTime('joined_at');
            $table->dateTime('last_visited_at');
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
        Schema::dropIfExists('message_room_memberships');
    }
}
