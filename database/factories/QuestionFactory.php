<?php

namespace Database\Factories;

use App\Models\Polls;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'question_description' => rtrim(fake()->sentence(20), '.'),
           'votes' => rand(0,User::all()->count()),
           'choices' =>  rand(0, 5),
           'pollId' => Polls::all()->random()->id
        ];
    }
}
