<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;
/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    return [
        
        'freelancer_id' => \App\Models\Freelancer::factory(),
        'post_id'       => \App\Models\Post::factory(),
        
        'offer_price'   => fake()->numberBetween(500, 3000),
        'description'   => fake()->paragraph(),
        'days'          => fake()->numberBetween(1, 10),
        'status'        => 'pending',
    ];
}
}
