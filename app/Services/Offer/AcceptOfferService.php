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
        if($acceptedOffer->status == 'accepted') return 0;

        $postId = $acceptedOffer->post_id;

        Offer::where('post_id', $postId)
            ->update(['status' => 'rejected']);

        
        $acceptedOffer->update(['status' => 'accepted']);

        $acceptedOffer->post->update(['status' => 'in_progress']);


        $this->notification->send(
            $acceptedOffer->user_id, 
            " your offer is accepted "
            );

        return $acceptedOffer;
        
    }
}