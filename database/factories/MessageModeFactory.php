<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageMode>
 */
class MessageModeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
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
        ];
    }
}
