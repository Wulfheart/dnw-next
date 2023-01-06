<?php

namespace App\Http\Livewire\Game;

use App\Models\MessageRoom;
use App\Queries\MessageRoomQueries;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;

class MessageRoomOverview extends Component
{
    use AuthorizesRequests;

    /** @var array<\App\DTO\Views\MessageRoomPreview> */
    public array $messageRoomPreviews;

    public int $power_id;

    public int $game_id;

    public function mount(
        int $power_id,
        int $game_id,
    ) {
        $this->power_id = $power_id;
        $this->game_id = $game_id;

        $this->populateMessageRoomPreviews();
    }

    protected function populateMessageRoomPreviews(): void
    {
        $rooms = MessageRoomQueries::getMessageRoomsForPower($this->power_id)
        ->sortByDesc(fn (MessageRoom $mr) => $mr->latestMessage?->created_at);

        $this->messageRoomPreviews = $rooms
            ->map(fn (MessageRoom $messageRoom) => new \App\DTO\Views\MessageRoomPreview(
                $messageRoom->id,
                $messageRoom->getNameForPower($this->power_id),
                $messageRoom->getColorForPower($this->power_id),
                Str::limit($messageRoom->latestMessage?->text, 500),
                $messageRoom->latestMessage?->sender->id == $this->power_id ? $messageRoom->latestMessage?->sender->basePower->name : 'Du',
                $messageRoom->getUnreadForPower($this->power_id),
                $messageRoom->latestMessage?->created_at,
            ))->values()->toArray();
    }

    public function render()
    {
        $this->populateMessageRoomPreviews();

        return view('livewire.game.message-room-overview');
    }
}
