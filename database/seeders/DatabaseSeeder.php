<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Polls;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::truncate();
        Polls::truncate();

        \App\Models\User::factory(10)->create();
        \App\Models\Polls::factory(10)->create();
        \App\Models\Question::factory(10)->create();
        \App\Models\Choices::factory(10)->create();
        //choices

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
