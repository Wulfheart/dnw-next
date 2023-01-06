<?php

namespace Database\Factories;

use App\Enums\PhaseTypeEnum;
use App\Models\Game;
use App\Models\Phase;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'type' => $this->faker->randomElement(PhaseTypeEnum::cases()),
            'number' => $this->faker->randomNumber(),
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
