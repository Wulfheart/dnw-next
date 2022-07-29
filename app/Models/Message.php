<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperMessage
 */
class Message extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'message_room_id' => 'integer',
        'sender_id' => 'integer',
    ];


    public function sender(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Power::class);
    }

    public function messageRoom(): BelongsTo
    {
        return $this->belongsTo(MessageRoom::class);
    }
}
