<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();
        
        Post::factory(10)->create()->each(function ($post) use ($tags) {
        $post->tags()->attach(
            $tags->random(rand(1, 5))->pluck('id')->toArray()
        );
        });
    }
}
