<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'user_id' => \App\Models\User::where('role', 'client')->inRandomOrder()->first()?->id 
            ?? \App\Models\User::factory()->create(['role' => 'client'])->id,
            'description' => $this->faker->paragraph(),
            'budget' => $this->faker->randomElement(['fixed', 'hourly']),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['open', 'closed', 'in_progress']),
        ];
    }
}
