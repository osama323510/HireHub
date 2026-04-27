<?php

namespace Database\Seeders;
use App\Models\Freelancer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Offer;
class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    
    $freelancers = Freelancer::where('is_verified', true)->get();

    $openPosts = \App\Models\Post::where('status', 'open')->get();

    foreach ($freelancers as $freelancer) {
        
        $randomPosts = $openPosts->random(rand(1, min(3, $openPosts->count())));
        foreach ($randomPosts as $post) {
            $alreadyExists = Offer::where('post_id', $post->id)
                                ->where('freelancer_id', $freelancer->id)
                                ->exists();
            if($alreadyExists) continue;
            Offer::factory()->create([
                'freelancer_id' => $freelancer->id,
                'post_id'       => $post->id,
                
            ]);
        }
    }
}
}
