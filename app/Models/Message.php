<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperMessage
 */
class Message extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'sender_id' => 'integer',
    ];


    public function sender()
    {
        return $this->belongsTo(\App\Models\Power::class);
    }
}
