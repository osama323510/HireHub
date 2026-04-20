<?php

namespace App\Http\Resources\Owner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'user'               => $this['user'],
        'post'               => $this['post'],
        'offer'              => $this['offer'],
        'total_offers_price' => $this['total_offers_price'] . " $",
        ];
    }
}
