<?php

namespace App\Services\Offer;
use App\Models\Offer;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\NotificationServiceInterface;
use App\Jobs\MailHandl;
use Illuminate\Validation\ValidationException;
class CreateOfferService
{

    protected $notification;
    public function __construct(NotificationServiceInterface $notification)
    {
        $this->notification = $notification;
    }
    
    public function create($data)
    {
    $user = Auth::user();
    $freelancerId = $user->freelancer->id;

    $post = Post::findorfail($data['post_id']);
    
    $this->ensureFreelancerCanOffer($post,$freelancerId);
    
    $offer=Offer::create([
        'freelancer_id' => $freelancerId,
        'post_id'       => $data['post_id'],
        'offer_price'   => $data['offer_price'],
        'description'   => $data['description'],
        'days'          => $data['days'],
    ]);
    $this->notification->send($offer->freelancer->user->email,'you created new offer');
    return $offer;

    }

    protected function ensureFreelancerCanOffer(Post $post, $freelancerId)
    {
        if ($post->status !== 'open') {
        throw ValidationException::withMessages([
        'message' => ['You can not make an offer on this post.'],
            ]);
        }

        $exists = Offer::where('post_id', $post->id)
                        ->where('freelancer_id', $freelancerId)
                        ->exists();

        if ($exists) {
        throw ValidationException::withMessages([
        'message' => ['You have already submitted an offer.'],
            ]);
            
        }
    }
}
