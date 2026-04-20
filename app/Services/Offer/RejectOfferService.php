<?php

namespace App\Services\Offer;

use App\Models\Offer;
use App\Interfaces\NotificationServiceInterface;

class RejectOfferService
{
    protected $notification;

    public function __construct(NotificationServiceInterface $notification)
    {
        $this->notification = $notification;
    }

    public function handleReject($id)
    {
        $offer = Offer::findOrFail($id);
        if($offer->status == 'rejected' ) return 0;
        
        $offer->update(['status' => 'rejected']);

        $this->notification->send(
            $offer->freelancer->user->id, 
            "your offer is Rejected  : " . $offer->post->title
        );

        return $offer;
    }
}