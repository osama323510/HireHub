<?php

namespace App\Services\Post;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function create($data)
    {
        $post = Post::create([
            'user_id'     => Auth::id(),
            'title'       => $data['title'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'budget'      => $data['budget'],
            'deadline'    => $data['deadline'],
        ]);

        $post->tags()->sync($data['tags']);

        return $post->load('tags'); 
    }
}