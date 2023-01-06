<?php

namespace Database\Factories;

use App\Models\MessageRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageRoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'is_group' => $this->faker->boolean,
        ];
    }
}
