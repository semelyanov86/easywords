<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $users = User::all();
        if ($users && $users->isNotEmpty()) {
            $userId = $users->random();
        } else {
            $userId = \App\Models\User::factory();
        }

        return [
            'original' => $this->faker->word(),
            'translated' => $this->faker->word(),
            'done_at' => null,
            'starred' => $this->faker->boolean(20),
            'language' => $this->faker->randomElement(config('app.supported_languages')),
            'views' => $this->faker->randomNumber(1),
            'user_id' => $userId,
            'shared_by' => null,
        ];
    }
}
