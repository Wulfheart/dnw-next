<?php

namespace App\Http\Livewire\Game;

use App\Models\Message;
use App\Models\MessageRoomMembership;
use Livewire\Component;

class SubmitMessage extends Component
{
    public int $messageRoomId;
    public int $powerId;
    public string $message = '';

    public function mount(
        int $messageRoomId,
        int $powerId,
    ) {
        $this->messageRoomId = $messageRoomId;
        $this->powerId = $powerId;
    }

    public function sendMessage(){
        Message::create([
            'message_room_id' => $this->messageRoomId,
            'sender_id' => $this->powerId,
            'text' => $this->message,
        ]);

        $this->emit('messageSent');

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.game.submit-message');
    }
}
