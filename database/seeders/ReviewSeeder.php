<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Freelancer;
use App\Models\Post;
use App\Models\Review;
use Database\Factories\ReviewFactory;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $reviewables = [
            Freelancer::class,
            Post::class, 
        ];

        $type = fake()->randomElement($reviewables);
        $reviewable = $type::inRandomOrder()->first();
        Review::factory()->count(10)->create([
            'reviewable_id'   => $reviewable->id,
            'reviewable_type' => $type,
        ]);



    }
}
