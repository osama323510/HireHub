<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'offers_count'   => (int) ($this->offers_count ?? 0),
            'average_rating' => $this->rating,
        

        'tags' => $this->whenLoaded('tags', function() {
                return $this->tags->map(function($tag) {
                    return [
                        'name'     => $tag->name,
                    ];
                });
            })
        ];
    }
}


