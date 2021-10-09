<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MessageRoom;
use App\Models\MessageRoomMembership;
use App\Models\Power;

class MessageRoomMembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageRoomMembership::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'power_id' => Power::factory(),
            'message_room_id' => MessageRoom::factory(),
            'joined_at' => $this->faker->dateTime(),
            'last_visited_at' => $this->faker->dateTime(),
        ];
    }
}
