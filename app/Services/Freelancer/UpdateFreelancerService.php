<?php

namespace App\Services\Freelancer;
use App\Models\Freelancer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateFreelancerService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
    public function update(array $data)
    {
        return DB::transaction(function () use ($data) {
        $freelancer = Freelancer::with('user')->findOrFail($data['id']);
        
        $freelancer->user->update([
            'name'     => $data['name'] ?? $freelancer->user->name,
            'lastname' => $data['lastname'] ?? $freelancer->user->lastname,
            'address'  => $data['address'] ?? $freelancer->user->address,
            'image'      => $data['image'] ?? $freelancer->user->image,
        ]);

        $currentPortfolio = $freelancer->portfolio ?? [];

        if (isset($data['portfolio'])) {

        $currentPortfolio[] = $data['portfolio'];
                                                    }
                                                    
        $freelancer->update([
            'hour_price' => $data['hour_price'] ?? $freelancer->hour_price,
            'bio'        => $data['bio'] ?? $freelancer->bio,
            'portfolio'  => $currentPortfolio,
            'phone'    => $data['phone'] ?? $freelancer->phone,
            'status'   =>$data['status']??$freelancer->status,
        ]);

        

    if (isset($data['skills'])) {
        $skillsWithPivot = [];
        foreach ($data['skills'] as $skill) {
            $skillsWithPivot[$skill['id']] = [
                'years_of_experience' => $skill['years']
            ];
        }
        $freelancer->skills()->sync($skillsWithPivot);
    }

    return $freelancer->load(['skills', 'user']);
        });
    }
}
