<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MessageRoomMembership extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'power_id',
        'message_room_id',
        'joined_at',
        'last_visited_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'power_id' => 'integer',
        'message_room_id' => 'integer',
        'joined_at' => 'datetime',
        'last_visited_at' => 'datetime',
    ];


    public function power()
    {
        return $this->belongsTo(\App\Models\Power::class);
    }

    public function messageRoom()
    {
        return $this->belongsTo(\App\Models\MessageRoom::class);
    }
}
