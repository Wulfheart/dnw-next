<?php

namespace App\Collections;

use App\Models\MessageRoomMembership;
use Illuminate\Database\Eloquent\Collection;

/**
 * @implements Collection<int, \App\Models\MessageRoomMembership>
 */
class MessageRoomMembershipCollection extends Collection
{
    public function forPower(int $power_id): MessageRoomMembership {
        /** @var MessageRoomMembership $current */
        return  $this->where("power_id", $power_id)->firstOrFail();
    }

}