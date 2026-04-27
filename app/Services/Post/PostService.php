<?php

namespace App\Services\Post;
use App\Models\Post;
class PostService
{



public function getAll($data)
{
        return Post::query()
        ->when($data['newpost'] ?? null, function ($query) {
                return $query->newpost(); 
        })
        ->when($data['thisMonth'] ?? null, function ($query) {
                return $query->thisMonth();
        })
        ->when($data['budgetlimit'] ?? null, function ($query, $budget) {
                return $query->budgetlimit($budget);
        })
        ->with(['user', 'tags'])
        ->withCount('offers')
        ->withAvg('reviews', 'rating') 
        ->latest()
        ->paginate(10);
}



}
