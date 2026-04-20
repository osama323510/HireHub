<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostResource extends JsonResource
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
            'description' => $this->description,
            'user_id' => $this->user_id,
            'budget' => $this->budget,
            'price' => $this->price,
            'status' => $this->status,
            'deadline' => $this->deadline,

            'offers'=>$this->whenLoaded('offers', function() {
                return $this->offers->map(function($offer) {
                    return [
                        'description'=> $offer->description,
                        'days'=> $offer->days,
                        'status'=> $offer->status,
                        'offer_price'=> $offer->offer_price
                    ];
                });
            }),

            'reviews'=>$this->whenLoaded('reviews', function() {
                return $this->reviews->map(function($review) {
                    return [
                        'comment'=>$review->comment ,
                        'rating'=>"⭐ " . number_format($review->rating, 1),
                    ];
                });
            }),


            'Attachments'=>$this->whenLoaded('Attachments', function() {
                return $this->Attachments->map(function($Attachment) {
                    return [
                        'file'=> $Attachment->file
                    ];
                });
            }),

            'tags' => $this->whenLoaded('tags', function() {
                    return $this->tags->map(function($tag) {
                        return [
                            // 'tag_id'   => $tag->id,
                            'name'     => $tag->name,
                        ];
                    });
                })
        ];
    }
}
