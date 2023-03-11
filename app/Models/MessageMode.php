<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageMode extends Model
{
    use HasFactory;

    protected $casts = [
        'room_creation_allowed' => 'boolean',
        // Currently no effect
        'signing_allowed' => 'boolean',
        'adjustment_messages_allowed' => 'boolean',
        'move_messages_allowed' => 'boolean',
        'retreat_messages_allowed' => 'boolean',
        // Currently no effect
        'non_playing_messages_allowed' => 'boolean',
        // Currently no effect
        'pre_game_messages_allowed' => 'boolean',
        // Currently no effect
        'post_game_messages_allowed' => 'boolean',
        'show_player_identities_during_game' => 'boolean',
        'is_custom' => 'boolean',
    ];
}
