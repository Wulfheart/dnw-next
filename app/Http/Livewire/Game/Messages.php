<?php

namespace App\Http\Livewire\Game;

use App\Models\Message;
use App\Models\MessageRoom;
use Livewire\Component;

class Messages extends Component
{



    public int $messageRoomId;
    public int $power_id;
    public int $amount = 25;
    public int $maxMessagesCount;

    public function mount(
        int $messageRoomId,
        int $power_id,
    ){
        $this->messageRoomId = $messageRoomId;
        $this->power_id = $power_id;
    }

    public function maxCount() {
        $this->maxMessagesCount = Message::where('message_room_id', $this->messageRoomId)->count();
    }

    public function increaseAmount() {
            $this->amount += 25;
    }


    public function getMessages(): array
    {

        $messages = Message::with("sender.basePower")->where('message_room_id', $this->messageRoomId)->limit($this->amount)->orderByDesc('created_at')->get();
        $this->maxCount();

        return $this->messages = collect($messages)->map(fn(Message $message) => new \App\DTO\Views\Message(
            $message->id,
            $message->sender->basePower->name,
            $message->sender->basePower->color,
            $message->text,
            $message->sender->id == $this->power_id,
            $message->created_at,
        ))->values()->toArray();

    }

    public function showMore(): bool {
        return $this->amount < $this->maxMessagesCount;
    }


    public function render()
    {
        return view('livewire.game.messages', [
            'messages' => $this->getMessages(),
            'showMore' => $this->showMore(),
        ]);
    }
}
