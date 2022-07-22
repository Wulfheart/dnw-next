<?php

namespace Database\Factories;

use App\Models\MessageMode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Game;
use App\Models\Variant;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'variant_id' => Variant::factory(),
            'message_mode_id' => MessageMode::factory()->create()->id,
            'phase_length' => $this->faker->randomNumber(),
            'is_paused' => $this->faker->boolean
        ];
    }
}
