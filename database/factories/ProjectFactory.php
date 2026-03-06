<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Jika tidak didefinisikan, akan otomatis buat user baru
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
        ];
    }
}
