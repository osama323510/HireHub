<?php

namespace App\Services\Freelancer;
use App\Models\Freelancer;
use Illuminate\Support\Facades\Cache;
class FreelancerService
{
public function getFreelancerInfo()
    {

        return Cache::remember('freelancer:available', 3600, function () {
            
            return  Freelancer::query()
                ->verifiedAndActive()
                ->available()
                ->with([
                    'user', 
                    'skills' => fn($q) => $q->withPivot('years_of_experience')
                ])
                ->get();
        });


    }
}


