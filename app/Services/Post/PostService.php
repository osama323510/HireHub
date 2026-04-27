<?php

namespace App\Services\Post;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService
{

        public function getAll()
        {
                return Cache::remember('post:open',3600, 
                function ()  {

                return Post::query()
                ->newpost()
                ->with(['user', 'tags'])
                ->withCount('offers')
                ->withAvg('reviews', 'rating') 
                ->latest()
                ->get();
                });

        }

}
