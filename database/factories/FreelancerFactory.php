<?php

namespace Database\Factories;

use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;

class FreelancerFactory extends Factory
{
    protected $model = Freelancer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    return [
        
        'user_id'     => User::factory(), 
        'phone'       => fake()->numerify('9639########'),
        'hour_price'  => fake()->randomFloat(2, 10, 100),
        'bio'         => fake()->paragraph(),   
        'rating'      =>0,
        'is_active'   => 1,
        'is_verified' => 1,
        'status'      => 'available',
        'portfolio'   => [
            'projects' => [
                'title'       => fake()->sentence(),
                'description' => fake()->paragraph(),
            ],
        ],
    ];
}
}
