<?php

namespace App\Services\Owner;
use App\Models\User;
use App\Models\Post;
use App\Models\Offer;
class OwnerService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function getData()
    {
        
        $data=[
            'user'=>User::count(),
            'post'=>Post::count(),
            'offer'=>Offer::count(),
            'total_offers_price' => Offer::sum('offer_price'),
        ];

        return $data;

    }
}
