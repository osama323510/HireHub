<?php

namespace Database\Factories;


use App\Models\Review;
use App\Models\User;
use App\Models\Freelancer;
use App\Models\Post; 
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     *
     */


    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id'         => User::where('role','client')->inRandomOrder()->first()->id,
            'comment'         => fake()->paragraph(),
            'rating'          => fake()->randomFloat(1, 1, 5),
            'reviewable_id'   => '',
            'reviewable_type' => '',
        ];
    }

}




