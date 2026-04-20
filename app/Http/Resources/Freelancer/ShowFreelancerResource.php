<?php

namespace App\Http\Resources\Freelancer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowFreelancerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

public function toArray(Request $request): array
{
    return [
        'id'      => $this->id,
        'name'    => $this->user->full_name(),
        'image'   => $this->user->avatarUrl,
        'address' => $this->user->address,
        'city'    => $this->user->city?->name, 
        'country' => $this->user->country?->name,
        'rating'  => $this->rate,
        'phone'   => $this->phone,
        'pro'     => $this->portfolio,
        'bio'     => $this->bio,
        'joined'  => $this->user->joinedDate,
        'offers_count'=>$this->offers_count ?? 0,

        'skills' => $this->whenLoaded('skills', function() {
            return $this->skills->map(function($skill) {
                return [
                    'skill_id' => $skill->id,
                    'name'     => $skill->name,
                    'years'    => $skill->pivot->years_of_experience, 
                ];
            });
        }),
    ];
}
}
