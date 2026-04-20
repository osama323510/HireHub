<?php

namespace App\Services\Post;
use App\Models\Post;
class ShowPostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function show($id)
    {
        $post=Post::query()
        ->where('id',$id)
        ->with(['user', 'tags','offers','reviews'])
        ->first();

        if(!$post)
        {
            return 0;
        }
        return $post;
    }
}
