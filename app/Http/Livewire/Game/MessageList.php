<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use App\Models\MessageRoom;
use Livewire\Component;

class MessageList extends Component
{
    public Game $game;

    public function mount(Game $game){
        $this->game = $game;
        $game->loadMissing('messageMode');
    }

    public function render()
    {
        return view('livewire.game.message-list', [
            // 'messageRooms' =>
        ]);
    }
}
