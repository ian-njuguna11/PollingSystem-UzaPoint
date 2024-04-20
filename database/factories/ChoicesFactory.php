<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'choice_desc' => rtrim( fake()->sentence(rand(2,10)), '.' ),
            'votes' => rand(0,User::all()->count()),
            'questionId' => Question::all()->random()->id
        ];
    }
}
