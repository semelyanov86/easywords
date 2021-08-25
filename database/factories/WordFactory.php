<?php

namespace Database\Factories;

use App\Models\Word;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Word::class;

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
            'done_at' => $this->faker->dateTime,
            'starred' => $this->faker->boolean,
            'language' => $this->faker->text(5),
            'views' => 0,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
