<?php

namespace App\Models;

use App\Collections\MessageRoomMembershipCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageRoomMembership extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'power_id' => 'integer',
        'message_room_id' => 'integer',
        'joined_at' => 'datetime',
        'last_visited_at' => 'datetime',
    ];

    public function newCollection(array $models = []): MessageRoomMembershipCollection
    {
        return new MessageRoomMembershipCollection($models);
    }

    public function power(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Power::class);
    }

    public function messageRoom(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\MessageRoom::class);
    }
}
