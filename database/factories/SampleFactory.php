<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SampleFactory extends Factory
{
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
