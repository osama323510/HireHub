<?php
namespace App\Services\Offer;

use App\Models\Offer;
use App\Interfaces\NotificationServiceInterface;
use App\Jobs\MailHandl;
use App\Jobs\OfferAccept;
use Illuminate\Support\Facades\DB;

class AcceptOfferService
{
    protected $notification;

    public function __construct(NotificationServiceInterface $notification)
    {
        $this->notification = $notification;
    }

    public function handleAccept($id)
    {

        $acceptedOffer = Offer::findOrFail($id);
        
        if(!$acceptedOffer) return "the offer is not found";
        elseif($acceptedOffer->status == 'accepted') return "you accept the offer befor";
        elseif($acceptedOffer->status == 'rejected') return "you can not accept offer which is rejected";

        $acceptedOffer->update(['status' => 'accepted']);

        $acceptedOffer->post->update(['status' => 'in_progress']);

        OfferAccept::dispatch($acceptedOffer->post_id,$id);

        $this->notification->send($acceptedOffer->freelancer->user->email,"you offer is Accept");

        return $acceptedOffer;
        
    }
}