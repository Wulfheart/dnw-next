<?php

namespace Database\Seeders;

use App\Models\MessageMode;
use Illuminate\Database\Seeder;

class MessageModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MessageMode::create([
            'name' => 'Normal',
            'is_custom' => false,
            'room_creation_allowed' => true,
            'signing_allowed' => true,
            'adjustment_messages_allowed' => true,
            'move_messages_allowed' => true,
            'retreat_messages_allowed' => true,
            'non_playing_messages_allowed' => true,
            'pre_game_messages_allowed' => true,
            'post_game_messages_allowed' => true,
            'show_player_identities_during_game' => true,
        ]);
    }
}
