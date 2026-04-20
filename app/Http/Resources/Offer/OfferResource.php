<?php

namespace App\Http\Resources\Offer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($data): array
    {
    return [
        'id'              => $this->id,
        'title'           => $this->post->title,
        'freelancer_name' => $this->freelancer->user->full_name(), 
        'offer_price'     => $this->offer_price . '$',
        'description'     => $this->description,
        'days'            => $this->days . ' days to finish',
        'status'          => $this->status??"pinding",
        'date'            => $this->created_at?->format('Y-m-d'),
    ];
    }
}
