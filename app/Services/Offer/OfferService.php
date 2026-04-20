<?php

namespace App\Services\Offer;
use App\Models\Offer;
class OfferService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function getOfferById($id)
    {
        $data=Offer::with(['freelancer.user', 'post'])->findOrFail($id);
        return $data;

    }
}
