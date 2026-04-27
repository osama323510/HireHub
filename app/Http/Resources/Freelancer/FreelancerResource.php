<?php

namespace App\Http\Resources\Freelancer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerResource extends JsonResource
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
        'rating'  => $this->rating??0,
        'joined'  => $this->user->joinedDate,

    ];
}
}

