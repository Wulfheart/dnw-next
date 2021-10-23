<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MessageRoom extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_group',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_group' => 'boolean',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(MessageRoomMembership::class);
    }

    public function powers(): BelongsToMany
    {
        // TODO: Why does this not work?
        // return $this->belongsToMany(Power::class)->using(MessageRoomMembership::class);
        return $this->belongsToMany(Power::class, 'message_room_memberships');
    }
}
