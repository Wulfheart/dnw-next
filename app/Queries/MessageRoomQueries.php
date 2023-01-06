<?php

namespace App\Queries;

use App\Models\MessageRoom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MessageRoomQueries
{
    /**
     * @param  int  $power_id
     * @return Collection<MessageRoom>
     */
    public static function getMessageRoomsForPower(int $power_id): Collection
    {
        return MessageRoom::with(['memberships.power.basePower', 'latestMessage.sender.basePower'])
            ->whereHas('memberships', fn (Builder $builder) => $builder->where('power_id', $power_id))
            ->get();
    }
}
