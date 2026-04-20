<?php

namespace App\Services\Freelancer;
use App\Models\Freelancer;

class FreelancerService
{
    public function getFreelancerInfo(array $filters = [])
    {
        return Freelancer::query()
            
            ->when(isset($filters['verified']), function ($query) {
                $query->verifiedAndActive();
            })

            ->when(isset($filters['available']), function ($query) {
                $query->available();
            })

            ->withAvg('reviews', 'rating')
            ->with([
                'user', 
                'skills' => fn($q) => $q->withPivot('years_of_experience')
            ])
            
            ->when(isset($filters['sort_by_rating']), 
                fn($q) => $q->orderByRating(), 
                fn($q) => $q->latest()
            )
            ->paginate($filters['per_page'] ?? 10);
    }
}


