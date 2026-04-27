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
        
        for ($i = 0; $i < 20; $i++) {
        $reviewables = [Freelancer::class, Post::class];
        $type = fake()->randomElement($reviewables);
        if ($type == Freelancer::class) {
            $model = Freelancer::inRandomOrder()->first() ?? Freelancer::factory()->create();
        } else {
            $model = Post::where('status', 'closed')->inRandomOrder()->first() 
                    ?? Post::factory()->create(['status' => 'closed']);
        }
        Review::factory()->create([
            'reviewable_id'   => $model->id,
            'reviewable_type' => $type,
        ]);
    }



    }
}




