<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Phase;

class PhaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(["MOVE","ADJUSTMENT","RETREAT","NON_PLAYING"]),
            'previous_phase_id' => Phase::factory(),
            'svg_adjudicated' => $this->faker->text,
            'svg_with_orders' => $this->faker->text,
            'state_encoded' => $this->faker->text,
            'phase_name_long' => $this->faker->word,
            'phase_name_short' => $this->faker->word,
            'adjudication_at' => $this->faker->dateTime(),
            'adjudicated_at' => $this->faker->dateTime(),
            'game_id' => Game::factory(),
        ];
    }
}
