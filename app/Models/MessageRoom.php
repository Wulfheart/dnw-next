<?php

namespace App\Models;

use App\Collections\MessageRoomMembershipCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MessageRoom extends Model
{
    use HasFactory;

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

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function getNameForPower(int $power_id): string
    {
        $this->loadMissing('memberships.power.basePower');
        if($this->is_group){
            return $this->name;
        } else {
            $otherMember = $this->memberships->where('power_id', '!=', $power_id)->first();
            return $otherMember->power->basePower->name;
        }
    }
    public function getColorForPower(int $power_id): string
    {
        $this->loadMissing('memberships.power.basePower');
        if($this->is_group){
            return "black";
        } else {
            $otherMember = $this->memberships->where('power_id', '!=', $power_id)->first();
            return $otherMember->power->basePower->color;
        }
    }

    public function getUnreadForPower(int $power_id): bool
    {
        $this->loadMissing('latestMessage', 'memberships');
        $this->loadCount('messages');
        if($this->messages_count == 0){
            return false;
        }

        return $this->memberships->forPower($power_id)->last_visited_at->lessThan($this->latestMessage->created_at);
    }
}
