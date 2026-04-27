<?php

namespace App\Services\Offer;

use App\Models\Offer;
use App\Interfaces\NotificationServiceInterface;
use App\Jobs\MailHandl;

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

        if(!$offer) return "the offer is not found";
        elseif($offer->status == 'accepted') return "you can not reject offer which is accepted";
        elseif($offer->status == 'rejected') return "you reject the offer befor";
        
        $offer->update(['status' => 'rejected']);

        $this->notification->send($offer->freelancer->user->email,"you offer is Rejected");

        return $offer;
    }
}