<?php

namespace App\Services\Offer;
use App\Models\Offer;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\NotificationServiceInterface;
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
    
    $alreadyOffered = Offer::where('post_id', $data['post_id'])
                        ->where('freelancer_id', $freelancerId)
                        ->exists();

    if ($alreadyOffered) {
        
        throw new \Illuminate\Validation\ValidationException(
        validator(data: [], rules: []), 
        response()->json(['message' => "You have already submitted an offer for this post."], 422)
    );
    }

    if (!$post || $post->status != "open") {
        throw new \Illuminate\Validation\ValidationException(
        validator(data: [], rules: []), 
        response()->json(['message' => "the post in colsed now."], 422)
    );
    }
    
    $offer=Offer::create([
        'freelancer_id' => $freelancerId,
        'post_id'       => $data['post_id'],
        'offer_price'   => $data['offer_price'],
        'description'   => $data['description'],
        'days'          => $data['days'],
    ]);

    $this->notification->send($post->user->id,"new offer ");
    
    return $offer;

    }
}
