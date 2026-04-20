<?php

namespace App\Services\Freelancer;
use App\Models\Freelancer;
class FreelancerWithIdService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
        public function infoWithId($id)
    {
        $freelancer=Freelancer::query()
        ->where('id',$id)
        ->withAvg('reviews', 'rating')
        ->with([
            'user', 
            'skills' => function($query) {
                $query->withPivot('years_of_experience'); 
            }
        ])
        ->withCount(['offers' => function ($query) {
            $query->where('status', 'accepted'); 
        }])
        ->first();

        if($freelancer== null)
        {
            throw new \Illuminate\Validation\ValidationException(
            validator(data: [], rules: []), 
            response()->json(['message' => "no freelancer ."], 422));
        }

        return $freelancer;
        
    }
}
