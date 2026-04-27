<?php

namespace App\Services\Review;

use App\Jobs\FreelancerRating;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CreateReviewService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function create($data)
    {
        
    $review=Review::create([
        'user_id'         => auth()->id(), 
        'comment'         => $data['comment'], 
        'rating'          => $data['rating'],
        'reviewable_id'   => $data['reviewable_id'],
        'reviewable_type' => $data['reviewable_type'],
    ]);
    if ($data['reviewable_type'] === \App\Models\Freelancer::class) {
        FreelancerRating::dispatch($data['reviewable_id']);
    }
    return $review;
    }
}
