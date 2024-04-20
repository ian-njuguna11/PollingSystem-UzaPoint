<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Polls>
 */
class PollsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
        'poll_tittle' => rtrim(fake()->sentence(2), '.'),
        'votes' => rand(0,10),
        'questions' => rand(0, 10),
        'userId' => User::all()->random()->id,
        'end_date' => fake()->date()
        ];
    }
}
