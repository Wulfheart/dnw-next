<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Variant;

class VariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'api_name' => $this->faker->word,
            'name' => $this->faker->name,
            'default_scs_to_win' => $this->faker->randomNumber(),
            'total_scs' => $this->faker->randomNumber()
        ];
    }
}
