<?php

namespace Database\Factories;

use App\Models\Sample;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SampleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sample::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'original' => $this->faker->text(255),
            'translated' => $this->faker->text(255),
            'language' => $this->faker->text(5),
        ];
    }
}
