<?php
namespace App\Services\Offer;

use App\Models\Offer;
use App\Interfaces\NotificationServiceInterface;
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


        $postId = $acceptedOffer->post_id;

        $acceptedOffer->update(['status' => 'accepted']);
        
        $acceptedOffer->post->update(['status' => 'in_progress']);

        Offer::where('post_id', $postId)
            ->update(['status' => 'rejected']);

        $this->notification->send(
            $acceptedOffer->freelancer->user->email, 
            " your offer is accepted "
            );

        return $acceptedOffer;
        
    }
}